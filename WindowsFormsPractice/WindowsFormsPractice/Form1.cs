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
        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            if (File.Exists("favorite.xml"))
            {
                XmlSerializer serializer = new XmlSerializer(typeof(List<FavoriteData>));
                List<FavoriteData> favoriteDataList = null;
                using (StreamReader reader = new StreamReader("favorite.xml"))
                {
                    favoriteDataList = (List<FavoriteData>)serializer.Deserialize(reader);
                }

                for (int i = 0; i < favoriteDataList.Count; i++) { 
                    listFavorite.Items.Add(favoriteDataList[i]);
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
            using (StreamWriter writer = new StreamWriter("favorite.xml", false, Encoding.UTF8)) {
                serializer.Serialize(writer, favoriteDataList);
            }
        }

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
            txtUrl.Text = browser.Url.ToString();
            btnBack.Enabled = browser.CanGoBack;
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

            browser.Url = new Uri(data.Url);
        }

        // お気に入り追加処理
        private void btnAddFavorite_Click(object sender, EventArgs e)
        {
            // お気に入りデータの設定
            FavoriteData data = new FavoriteData();
            data.Title = browser.DocumentTitle;
            data.Url = browser.Url.ToString();

            // リストに追加
            listFavorite.Items.Add(data);
        }

        // お気に入り削除処理
        private void btnRemoveFavorite_Click(object sender, EventArgs e)
        {
            // 選択されているデータの取得
            FavoriteData data = (FavoriteData)listFavorite.Items[listFavorite.SelectedIndex];

            if (listFavorite.Items.Count > 0) { 
                // リストからデータを削除
                listFavorite.Items.Remove(data);
            }
        }
    }

    public class FavoriteData 
    {
        public String Title = "";
        public String Url = "";

        public override string ToString()
        {
            return Title;
        }
    }
}
