from sklearn import datasets
from sklearn import svm
from sklearn import metrics
import matplotlib.pyplot as plt

digits = datasets.load_digits()

n = len(digits.data) * 1 // 2
X_training = digits.data[:n]
Y_training = digits.target[:n]
X_test = digits.data[n:]
Y_test = digits.target[n:]

lng = svm.SVC(gamma = 0.001)
lng.fit(X_training, Y_training)
print(lng.score(X_test, Y_test))
predicted = lng.predict(X_test)
print(predicted)
print(metrics.classification_report(Y_test, predicted))