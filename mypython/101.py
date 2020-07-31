from tensorflow.python.client import device_lib
device_lib.list_local_devices()

# if��
if "a1" in ["a1","b1"]:
  print(True)
else:
  print(False)

# for����if���i���X�g����\�L�j
plus1 = [i+1 for i in [1,2,3,4,5] if i>= 3]
print(plus1)

# ���X�g���v�f�̕������ilen�j
print([len(e) for e in tw_strings])

# �����񕪊�(split)
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
  ngram���v�Z���ĕԋp
  Args:
    s(str):��͑Ώە�����
    n(int):n
    Returns:
      ngram(list):n-gram���X�g
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
s="�V�^�R���i�̃��N�`���������~�����B"
print(ngram(s,3))

# penta-gram
def pentagram_set(s):
  return {(s[i],s[i+1],s[i+2],s[i+3],s[i+4]) for i in range(len(s)) if i+4 < len(s)}
s1 = pentagram_set("�삯�o���G���W�j�A�ƌq���肽��")
s2 = pentagram_set("�t���X�^�b�N�G���W�j�A�ƌq���肽��")
print(s1 | s2)
print(s1 & s2)
print(s1 - s2)
print(("�G","��","�W","�j","�A") in s1)
print(("�G","��","�W","�j","�A") in s2)

# CSV
import pandas as pd

group_pinfo = [
  {
    "ID":1,
    "���O":"�P�F",
    "�N��":"23",
    "����":"�j"
  },
  {
    "ID":2,
    "���O":"��",
    "�N��":"21",
    "����":"��"
  },
  {
    "ID":3,
    "���O":"��Y",
    "�N��":"53",
    "����":"�j"
  },
  {
    "ID":4,
    "���O":"�v�u",
    "�N��":"48",
    "����":"��"
  },
  {
    "ID":5,
    "���O":"��Y",
    "�N��":"28",
    "����":"�j"
  }
]

group_binfo = [
  {
    "ID":1,
    "�S��":"�{�[�J��",
    "�":"�c�B�b�^�["
  },
  {
    "ID":2,
    "�S��":"�{�[�J��",
    "�":"���̎U��"
  },
  {
    "ID":3,
    "�S��":"�x�[�X",
    "�":"�ʐ^"
  },
  {
    "ID":4,
    "�S��":"�M�^�[",
    "�":"���J�j�b�N"
  },
  {
    "ID":5,
    "�S��":"�M�^�[",
    "�":"���M����"
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

df_pb['�N��'].to_csv('col1.txt', index = None)
df_pb['�'].to_csv('col2.txt', index = None)

!cat col1.txt
!echo '---'
!cat col2.txt