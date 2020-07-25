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

        private void webBrowser1_DocumentCompleted(object sender, WebBrowserDocumentCompletedEventArgs e)
        {

        }

        private void Form1_Load(object sender, EventArgs e)
        {
            // webBrowser1.Url = new Uri("http://www.google.co.jp");
        }

        private void textBox1_TextChanged(object sender, EventArgs e)
        {

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
    }
}
