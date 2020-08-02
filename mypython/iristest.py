import pandas as pd
import numpy as np
from sklearn.datasets import load_iris
from sklearn.model_selection import train_test_split
from sklearn.neighbors import KNeighborsClassifier

iris_dataset = load_iris()
print(pd.DataFrame(iris_dataset.data, columns=iris_dataset.feature_names))
print(pd.DataFrame(iris_dataset.target))

Training_Data, Test_Data, Training_Target, Test_Target = train_test_split(iris_dataset.data, iris_dataset.target, random_state=0)
print(pd.DataFrame(Test_Target))
print(pd.DataFrame(Training_Data))

knn = KNeighborsClassifier(n_neighbors=1)
knn.fit(Training_Data, Training_Target)

input = np.array([[5.8, 2.8, 5.1, 2.4]])
result = knn.predict(input)
print(np.mean(result == Test_Target))