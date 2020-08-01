import numpy as np
import math
from sklearn.metrics import mean_squared_error
from matplotlib import pyplot as plt

x = np.empty(0)
y = np.empty(0)

for i in range(200):
    m_i = i/10
    sinum = math.sin(m_i)
    x = np.append(x, sinum)
    y = np.append(y,m_i)

print(x)
print(y)

xy_rmse = np.sqrt(mean_squared_error(x,y))
print(xy_rmse)

plt.plot(y,x)
plt.show()