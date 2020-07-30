using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Xml.Serialization;

namespace WindowsFormsPractice
{
    public partial class Form1 : Form
    {
        public const String favoriteFile = "favorite.xml";  // お気に入りを保存するXML
        public const String locationFile = "location.xml";  // ウィンドウの位置情報を保存するXML

        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            if (File.Exists(favoriteFile))
            {
                XmlSerializer serializer = new XmlSerializer(typeof(List<FavoriteData>));
                List<FavoriteData> favoriteDataList = null;
                using (StreamReader reader = new StreamReader(favoriteFile))
                {
                    favoriteDataList = (List<FavoriteData>)serializer.Deserialize(reader);
                }

                for (int i = 0; i < favoriteDataList.Count; i++) { 
                    listFavorite.Items.Add(favoriteDataList[i]);
                }
            }

            if (File.Exists("location.xml")) 
            {
                XmlSerializer serializer = new XmlSerializer(typeof(LocationSizeData));
                LocationSizeData locationSizeData = null;
                using (StreamReader reader = new StreamReader(locationFile))
                {
                    locationSizeData = (LocationSizeData)serializer.Deserialize(reader);
                    this.Top    = locationSizeData.GetTop();
                    this.Left   = locationSizeData.GetLeft();
                    this.Width  = locationSizeData.GetWidth();
                    this.Height = locationSizeData.GetHeight();
                }
            }
        }

        private void Form1_FormClosed(object sender, FormClosedEventArgs e)
        {
            List<FavoriteData> favoriteDataList = new List<FavoriteData>();

            // リストボックス -> オブジェクト
            for (int i = 0; i < listFavorite.Items.Count; i++)
            {
                favoriteDataList.Add((FavoriteData)(listFavorite.Items[i]));
            }

            XmlSerializer serializer = new XmlSerializer(typeof(List<FavoriteData>));
            using (StreamWriter writer = new StreamWriter(favoriteFile, false, Encoding.UTF8)) {
                serializer.Serialize(writer, favoriteDataList);
            }

            if (this.WindowState.Equals(FormWindowState.Normal)) { 
                LocationSizeData locationSizeData = new LocationSizeData();

                locationSizeData.SetTop(this.Top);
                locationSizeData.SetLeft(this.Left);
                locationSizeData.SetWidth(this.Width);
                locationSizeData.SetHeight(this.Height);

                XmlSerializer serializer_l = new XmlSerializer(typeof(LocationSizeData));
                using (StreamWriter writer = new StreamWriter(locationFile, false, Encoding.UTF8))
                {
                    serializer_l.Serialize(writer, locationSizeData);
                }
            }
        }

        // ホームボタン
        private void btnHome_Click(object sender, EventArgs e)
        {
            browser.Url = new Uri("https://www.google.co.jp");
        }

        // 戻るボタン
        private void btnBack_Click(object sender, EventArgs e)
        {
            browser.GoBack();
        }

        // 進むボタン
        private void btnForward_Click(object sender, EventArgs e)
        {
            browser.GoForward();
        }

        // ページ移動時のイベント
        private void browser_Navigated(object sender, WebBrowserNavigatedEventArgs e)
        {
            txtUrl.Text        = browser.Url.ToString();
            btnBack.Enabled    = browser.CanGoBack;
            btnForward.Enabled = browser.CanGoForward;
        }

        private void txtUrl_KeyDown(object sender, KeyEventArgs e)
        {
            // Enterが押された時
            if (e.KeyCode.Equals(Keys.Enter)) {
                browser.Url = new Uri(txtUrl.Text);
            }
        }

        // お気に入りダブルクリック時
        private void listFavorite_DoubleClick(object sender, EventArgs e)
        {
            FavoriteData data = (FavoriteData)listFavorite.Items[listFavorite.SelectedIndex];

            browser.Url = new Uri(data.GetUrl());
        }

        // お気に入り追加処理
        private void btnAddFavorite_Click(object sender, EventArgs e)
        {
            if (browser.Url != null)
            {
                // お気に入りデータの設定
                FavoriteData data = new FavoriteData();
                data.SetTitle(browser.DocumentTitle);
                data.SetUrl(browser.Url.ToString());

                // 重複チェック
                if (!itemExists(data))
                {
                    // リストに追加
                    listFavorite.Items.Add(data);
                }
                else
                {
                    MessageBox.Show("既に登録済みです。");
                }
            }
            else {
                MessageBox.Show("サイトを表示してください。");
            }
        }

        // お気に入り存在チェック
        private bool itemExists(FavoriteData data1) {
            for(int i = 0; i < listFavorite.Items.Count; i++){
                FavoriteData data2 = (FavoriteData)listFavorite.Items[i];

                if (data1.GetUrl().Equals(data2.GetUrl())){
                    return true;
                }
            }
            return false;
        }

        // お気に入り削除処理
        private void btnRemoveFavorite_Click(object sender, EventArgs e)
        {
            if (listFavorite.SelectedIndex >= 0)
            {
                // 選択されているデータの取得
                FavoriteData data = (FavoriteData)listFavorite.Items[listFavorite.SelectedIndex];

                if (listFavorite.Items.Count > 0)
                {
                    // リストからデータを削除
                    listFavorite.Items.Remove(data);
                }
            }
            else {
                MessageBox.Show("リストを選択してください。");
            }
        }
    }

    // お気に入りデータ
    public class FavoriteData 
    {
        public String title = "";
        public String url = "";

        public void SetTitle(String t) {
            this.title = t;
        }

        public String GetTitle() {
            return this.title;
        }

        public void SetUrl(String u) {
            this.url = u;
        }

        public String GetUrl() {
            return this.url;
        }

        public override string ToString()
        {
            return this.title;
        }
    }

    public class LocationSizeData 
    {
        public int top    = 0;  // Y座標
        public int left   = 0;  // X座標
        public int width  = 0;  // 幅
        public int height = 0;  // 高さ

        public int GetTop() {
            return this.top;
        }

        public void SetTop(int t) {
            this.top = t;
        }

        public int GetLeft() {
            return this.left;
        }

        public void SetLeft(int l) {
            this.left = l;
        }
        public int GetWidth()
        {
            return this.width;
        }

        public void SetWidth(int w) {
            this.width = w;
        }

        public int GetHeight()
        {
            return this.height;
        }

        public void SetHeight(int h) {
            this.height = h;
        }
    }
}
