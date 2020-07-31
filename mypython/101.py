from tensorflow.python.client import device_lib
device_lib.list_local_devices()

# if文
if "a1" in ["a1","b1"]:
  print(True)
else:
  print(False)

# for文とif文（リスト内包表記）
plus1 = [i+1 for i in [1,2,3,4,5] if i>= 3]
print(plus1)

# リスト内要素の文字数（len）
print([len(e) for e in tw_strings])

# 文字列分割(split)
divided_tws = []
for tw in tw_strings:
  tws = tw.split("\n")
  divided_tws += [t for t in tws if t!='']
  print(len(divided_tws))
print(divided_tws[0:5])

# bi-gram
def bigram(s):
  return[(s[i], s[i+1]) for i in range(len(s)) if i + 1 < len(s)]
print(bigram(tw_strings[0]))

# tri-gram
def trigram(s):
  return[(s[i], s[i+1], s[i+2]) for i in range(len(s)) if i+2 < len(s)]
print(trigram(tw_strings[0]))

# n-gram
def ngram(s,n):
  '''
  ngramを計算して返却
  Args:
    s(str):解析対象文字列
    n(int):n
    Returns:
      ngram(list):n-gramリスト
  '''
  ngram = []
  for i in range(len(s)):
    if i+n >= len(s):
      break
    tpl = tuple()
    for j in range(n):
      tpl += (s[i+j],)
    ngram.append(tpl)
  return ngram
s="新型コロナのワクチンが早く欲しい。"
print(ngram(s,3))

# penta-gram
def pentagram_set(s):
  return {(s[i],s[i+1],s[i+2],s[i+3],s[i+4]) for i in range(len(s)) if i+4 < len(s)}
s1 = pentagram_set("駆け出しエンジニアと繋がりたい")
s2 = pentagram_set("フルスタックエンジニアと繋がりたい")
print(s1 | s2)
print(s1 & s2)
print(s1 - s2)
print(("エ","ン","ジ","ニ","ア") in s1)
print(("エ","ン","ジ","ニ","ア") in s2)

# CSV
import pandas as pd

group_pinfo = [
  {
    "ID":1,
    "名前":"輝彦",
    "年齢":"23",
    "性別":"男"
  },
  {
    "ID":2,
    "名前":"歩",
    "年齢":"21",
    "性別":"女"
  },
  {
    "ID":3,
    "名前":"二郎",
    "年齢":"53",
    "性別":"男"
  },
  {
    "ID":4,
    "名前":"久志",
    "年齢":"48",
    "性別":"女"
  },
  {
    "ID":5,
    "名前":"拓郎",
    "年齢":"28",
    "性別":"男"
  }
]

group_binfo = [
  {
    "ID":1,
    "担当":"ボーカル",
    "趣味":"ツィッター"
  },
  {
    "ID":2,
    "担当":"ボーカル",
    "趣味":"犬の散歩"
  },
  {
    "ID":3,
    "担当":"ベース",
    "趣味":"写真"
  },
  {
    "ID":4,
    "担当":"ギター",
    "趣味":"メカニック"
  },
  {
    "ID":5,
    "担当":"ギター",
    "趣味":"執筆活動"
  }
]

df1 = pd.DataFrame(group_pinfo)
df2 = pd.DataFrame(group_binfo)
df1.to_csv("group_pinfo.csv", index=None)
df2.to_csv("group_binfo.csv", index=None)

# CSV JOIN
!join -j 1 -t, "group_pinfo.csv" "group_binfo.csv"

# CSV JOIN 2
import pandas as pd

df1 = pd.read_csv("group_pinfo.csv", index_col = 0)
df2 = pd.read_csv("group_binfo.csv", index_col = 0)

df3 = pd.merge(df1, df2, on='ID', how='inner')

df3.to_csv("group_pbinfo.csv", index=None)

# CSV TO SPACE
import pandas as pd
df_pb = pd.read_csv("group_pbinfo.csv", index_col=0)
df_pb.to_csv("group_pbinfo_space.csv", sep=" ")
!cat "group_pbinfo_space.csv"

# CSV PROJECTION
import pandas as pd

df_pb = pd.read_csv("group_pbinfo.csv", index_col = 0)

df_pb['年齢'].to_csv('col1.txt', index = None)
df_pb['趣味'].to_csv('col2.txt', index = None)

!cat col1.txt
!echo '---'
!cat col2.txt