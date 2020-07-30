print("Good morning")
print("Good afternoon")
print("Good evening")

num = 1
numnum = num * 2
print(numnum)

string_a = "hello python"
print(string_a)
print(type(string_a))

a = 10
b = 1
bool01 = a > 1
print(bool01)
print(type(bool01))

ary = ["sato","tanaka","suzuki"]
print(ary)
print(ary[0])
print(ary[1])
print(ary[2])

for age in range(30):
    print(age)
    if age >= 20:
        print("adult")
    else:
        print("child")

def add(n1,n2):
    return n1 + n2

print(add(12,23))

class student:
    def __init__(self):
        self.avgsum = 0

    def avg(self,*point):
        for avgpt in point:
            self.avgsum = self.avgsum + avgpt    
        print(self.avgsum / len(point))

point = [70,80,90,65,57]

s01 = student()
s01.avg(*point)

