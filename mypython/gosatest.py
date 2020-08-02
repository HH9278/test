import numpy as np

t = np.array([0,0,0,0,1])
y = np.array([0.1,0.3,0,0.1,1.1])

def mean_squared_error(y, t):
    return ((y - t)**2).sum()

def cross_entropy_error(y, t):
    d = np.e - 7
    return -np.sum(t * np.log(y + d))

print(mean_squared_error(t, y))
print(cross_entropy_error(t, y))