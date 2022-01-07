from collections import Counter
import numpy as np
import matplotlib.pyplot as plt
from numpy import random

# -----------------------------------------------Q1----------------------------------------------


def randGen():
    # create a file named dataset.txt
    output_file = open("dataset.txt", "w")

    # uniformly distributed integer between 1 and 100
    Age = random.uniform(low=1, high=100, size=10000).astype(int)

    # randomly marked as Male or Female
    Gender = random.choice(['Male', 'Female'], size=(10000))

    # randomly chosen from the 28 States of India
    State = random.choice(
        ["Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh", "Goa", "Gujarat", "Haryana", "Himachal Pradesh", "Jharkhand", "Karnataka", "Kerala", "Madhya Pradesh", "Maharashtra",
            "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Odisha", "Punjab", "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura", "Uttar Pradesh", "Uttarakhand", "West Bengal"],
        size=(10000)
    )

    # random 10-digit numbers starting with 6, 7, 8 or 9
    Phone_number = []
    first_digit = random.choice([6, 7, 8, 9], size=(10000))
    for i in range(10000):
        remaining_digits = random.randint(low=1, high=9, size=(9))
        Phone_number.append(
            str(first_digit[i]) + ''.join(map(str, remaining_digits)))

    # Gaussian distributed real number with mean 160 cm and deviation 10 cm
    Height = random.normal(loc=160, scale=10, size=(10000))

    # Gaussian distributed real number with mean 70 kg and deviation 5 kg
    Weight = random.normal(loc=70, scale=5, size=(10000))

    # printing data into the file dataset.txt
    for i in range(10000):
        print("{}, {}, {}, {}, {} cm, {} kg".format(Age[i], Gender[i], State[i], Phone_number[i], round(
            Height[i], 2), round(Weight[i], 2)), file=output_file)

    output_file.close()

# -----------------------------------------------Q2----------------------------------------------


class Person:

    def __init__(self, Age, Gender, State, phone, Height, Weight):
        self.Age = int(Age)
        self.Gender = Gender
        self.State = State
        self.phone = phone
        self.Height = float(Height)
        self.Weight = float(Weight)

    def setAge(self):
        return (self.Age)

    def setGender(self):
        return (self.Gender)

    def setState(self):
        return (self.State)

    def setPhone(self):
        return (self.phone[0])

    def setHeight(self):
        return (self.Height)

    def setWeight(self):
        return (self.Weight)

    # -----------------------------------------------Q3----------------------------------------------
    # Generate 10000 instances of the Person class with data read from dataset.txt.


if __name__ == "__main__":
    randGen()
    Persons = []
    input_file = open("dataset.txt", "r")
    for line in input_file:  # for loop will loop 10,000 times
        x = line.split(", ")
        Persons.append(Person(x[0], x[1], x[2], x[3], x[4][:4], x[5][:4]))
    input_file.close()

    # -----------------------------------------------Q4----------------------------------------------

    append_file = open("dataset.txt", "a")
    totalWeight = 0
    totalHeight = 0
    for inst in Persons:
        totalHeight += inst.setHeight()  # Calculating totalHeight
        totalWeight += inst.setWeight()  # Calculating total Weight
    print("Average Height : ", round(totalHeight/10000, 2), file=append_file)
    print("Average Weight : ", round(
        totalWeight/10000, 2), file=append_file, end="")
    append_file.close()

    # -----------------------------------------------Q5----------------------------------------------

    maleHeight = []
    femaleHeight = []
    maleWeight = []
    femaleWeight = []
    maleAge = []
    femaleAge = []
    State = []
    Gender = [0, 0]
    Phone = [0, 0, 0, 0]

    for obj in Persons:
        State.append(obj.setState())

        if(obj.setGender() == "Male"):
            maleHeight.append(obj.setHeight())
            maleWeight.append(obj.setWeight())
            Gender[0] += 1
            maleAge.append(obj.setAge())
        else:
            femaleHeight.append(obj.setHeight())
            femaleWeight.append(obj.setWeight())
            Gender[1] += 1
            femaleAge.append(obj.setAge())

        if(obj.setPhone() == "6"):
            Phone[0] += 1
        elif(obj.setPhone() == "7"):
            Phone[1] += 1
        elif(obj.setPhone() == "8"):
            Phone[2] += 1
        elif(obj.setPhone() == "9"):
            Phone[3] += 1

    # creates two subplots, namely, histogram of male and female Heights
    plt.figure()
    plt.subplot(1, 2, 1)
    plt.hist(maleHeight, bins=200, color="blue")
    plt.title("Heights of Male")
    plt.xlabel('Height (in cm)')
    plt.ylabel('Number of Male')
    plt.subplot(1, 2, 2)
    plt.hist(femaleHeight, bins=200, color="red")
    plt.title("Heights of Female")
    plt.xlabel('Height (in cm)')
    plt.ylabel('Number of Female')
    plt.tight_layout()
    plt.savefig("height.jpg")

    # creates two subplots,histogram of male and female Weights
    plt.figure()
    plt.subplot(1, 2, 1)
    plt.hist(maleWeight, bins=200, color="blue")
    plt.title("Weights of Male")
    plt.xlabel('Weight (in kg)')
    plt.ylabel('Number of Male')
    plt.subplot(1, 2, 2)
    plt.hist(femaleWeight, bins=200, color="red")
    plt.title("Weights of Female")
    plt.xlabel('Weight (in kg)')
    plt.ylabel('Number of Female')
    plt.tight_layout()
    plt.savefig("weight.jpg")

    # creates a pie chart of male and female Gender
    plt.figure()
    plt.pie(Gender, labels=["Male", "Female"])
    plt.legend(title="Gender:", loc="best")
    plt.savefig("gender.jpg")

    # creates a pie chart of numbers starting with 6, 7, 8 and 9
    plt.figure()
    plt.pie(Phone, labels=["6", "7", "8", "9"])
    plt.legend(title="Phone Numbers starting with:", loc="best")
    plt.savefig("phone.jpg")

    # creates two line plots (with legend) of cumulative distribution function of male Age and female Age
    plt.figure()
    x1 = list(Counter(sorted(maleAge)).keys())
    y1 = list(Counter(sorted(maleAge)).values())
    cdfMale = np.cumsum(y1)
    x2 = list(Counter(sorted(femaleAge)).keys())
    y2 = list(Counter(sorted(femaleAge)).values())
    cdfFemale = np.cumsum(y2)
    plt.plot(x1, cdfMale, label="Male")
    plt.plot(x2, cdfFemale, label="Female")
    plt.legend(title="CDF of ages:", loc="best")
    plt.xlabel('age')
    plt.ylabel('Number of People Lying below a age')
    plt.savefig("age.jpg")

    # creates bar plot with State name on x-axis and number of people in that State (based on the dataset) as the bar Height
    plt.figure()
    x = list(Counter(sorted(State)).keys())
    y = list(Counter(sorted(State)).values())
    plt.bar(x, y)
    plt.xticks(x, x, rotation='vertical')
    plt.xlabel('States')
    plt.ylabel('Number of Persons')
    plt.savefig("state.jpg", bbox_inches='tight')
