using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

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
            // webBrowser1.Url = new Uri("http://www.google.co.jp");
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

            // リストからデータを削除
            listFavorite.Items.Remove(data);
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
