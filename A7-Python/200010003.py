from numpy import random
import numpy as np
import matplotlib.pyplot as plt
from collections import Counter

# (Q1) randGen() function, creation of dataset.txt
def randGen():

    # age is a uniformly distributed random integer in [1,100]
    Age = random.uniform(1, 100, size=10000).astype(int)

    # gender is chosen randomly between Male and Female
    Gender = random.choice(["Male", "Female"], size=10000)

    # Array of states, from which state is randomly chosen for each person
    State_list = ["Andhra Pradesh (AP)", "Arunachal Pradesh (AR)", "Assam (AS)", "Bihar (BR)", "Chhattisgarh (CG)", "Goa (GA)", "Gujarat (GJ)", "Haryana (HR)", "Himachal Pradesh (HP)", "Jammu and Kashmir (JK)", "Jharkhand (JH)", "Karnataka (KA)", "Kerala (KL)", "Madhya Pradesh (MP)", "Maharashtra (MH)", "Manipur (MN)", "Meghalaya (ML)", "Mizoram (MZ)", "Nagaland (NL)", "Odisha(OR)", "Punjab (PB)", "Rajasthan (RJ)", "Sikkim (SK)", "Tamil Nadu (TN)", "Telangana (TS)", "Tripura (TR)", "Uttar Pradesh (UP)", "Uttarakhand (UK)", "West Bengal (WB)"]
    State = random.choice(State_list, size=10000)

    # generate first half of phone number between 60000 and 99999
    # then generate the rest of the digits as any number between 0 and 99999
    phone_firsthalf = random.randint(60000, 99999, size=10000)
    phone_secondhalf = random.randint(0, 99999, size=10000)
    secondhalf_text = []
    Phone = []
    for x in range(10000):
        # temp is a string with second half of phone number with strictly 5 characters
        temp = "{:5d}".format(phone_secondhalf[x])

        # if there's an empty space, it is because the number has less than 5 digits,
        # so populate empty spaces with 0
        temp = temp.replace(" ", "0")

        # for the xth person, append temp to the secondhalf_text array of strings
        secondhalf_text.append(temp)

        # then concatenate both parts for that person
        Phone.append(str(phone_firsthalf[x]) + str(secondhalf_text[x]))

    # height is normally distributed with mean 160 and std deviation 10
    Height = random.normal(loc=160, scale=10, size=10000)

    # weight is normally distributed with mean 70 and std deviation 5
    Weight = random.normal(loc=70, scale=5, size=10000)

    # make a dataset file, or overwrite if it already exists
    datafile = open("dataset.txt", "w")
    for x in range(10000):
        # xth line has all info relating to xth person
        print("{}, {}, {}, {}, {}, {}".format(Age[x], Gender[x], State[x], Phone[x], Height[x], Weight[x]), file=datafile)
    datafile.close()

# (Q2) Creation of class Person

class Person:
    def __init__(self, Age, Gender, State, Phone, Height, Weight):
        self.Age = int(Age)
        self.Gender = str(Gender);
        self.State = str(State);
        self.Phone = str(Phone);               # int can't handle ten digits
        self.Height = float(Height);
        self.Weight = float(Weight);

# Main function is defined below: (it is called at the end)
def main():

    # call the function to generate dataset.txt
    randGen()

    # (Q3) generating 10000 instances of class Person using data read from dataset.txt
    # (Also part of Q4) to get total height and weight of all people
    all_info = []                              # to store all the class instances (objects)
    datafile = open("dataset.txt", "r")

    h_total = 0
    w_total = 0

    # make an array of objects called all_info
    for info in datafile:
        data = info.split(", ")
        all_info.append(Person(data[0], data[1], data[2], data[3], data[4], data[5]))
        temp1 = float(data[4])
        temp2 = float(data[5])
        h_total += temp1
        w_total += temp2
    datafile.close()

    # (Rest of Q4) Calculation of average height and weight, append to file

    append_to_file = open("dataset.txt", "a")
    print("Average height = ", (h_total/10000), file = append_to_file)
    print("Average weight = ", (w_total/10000), file = append_to_file)
    append_to_file.close()

    # (Q5: Groundwork)
    heights_male = []
    heights_female = []
    weights_male = []
    weights_female = []
    gender_freq = [0, 0]
    phone_firstdig_freq = [0, 0, 0, 0]
    ages_male = []
    ages_female = []
    state_list = []

    for line in all_info:

        # For Q5A, Q5B, Q5C, Q5E
        if(line.Gender == "Male"):
            heights_male.append(line.Height)
            weights_male.append(line.Weight)
            gender_freq[0] += 1
            ages_male.append(line.Age)
        else:
            heights_female.append(line.Height)
            weights_female.append(line.Weight)
            gender_freq[1] += 1
            ages_female.append(line.Age)

        # for Q5D
        first_dig = line.Phone[0]
        if first_dig == "6":
            phone_firstdig_freq[0] += 1
        elif first_dig == "7":
            phone_firstdig_freq[1] += 1
        elif first_dig == "8":
            phone_firstdig_freq[2] += 1
        elif first_dig == "9":
            phone_firstdig_freq[3] += 1

        # For Q5F
        state_list.append(line.State)


    # (Q5A) Subplots of histograms of male and female heights
    plt.figure()
    plt.subplot(1, 2, 1) # this figure has 1 row, 2 columns, this is the first plot
    plt.hist(heights_male, bins = 250, color = "#cc0066")
    plt.xlabel("Heights (cm) ->")
    plt.ylabel("Number of Males ->")

    plt.subplot(1, 2, 2) # this figure has 1 row, 2 columns, this is the second plot
    plt.hist(heights_female, bins = 250, color = "#000066")
    plt.xlabel("Heights (cm) ->")
    plt.ylabel("Number of Females ->")

    plt.tight_layout(); # to prevent overlap of the label of one subplot with the other subplot
    plt.savefig("height.jpg") # save the constructed figure


    # (Q5B) Subplots of histograms of male and female weights
    plt.figure()
    plt.subplot(1, 2, 1) # this figure has 1 row, 2 columns, this is the first plot
    plt.hist(weights_male, bins = 250, color = "#cc0066") # bins denote the "buckets" of the histogram
    plt.xlabel("Weights (kg) ->")
    plt.ylabel("Number of Males ->")

    plt.subplot(1, 2, 2) # this figure has 1 row, 2 columns, this is the second plot
    plt.hist(weights_female, bins = 250, color = "#000066") # bins denote the "buckets" of the histogram
    plt.xlabel("Heights (kg) ->")
    plt.ylabel("Number of Females ->")

    plt.tight_layout(); # to prevent overlap of the label of one subplot with the other subplot
    plt.savefig("weight.jpg") # save the constructed figure
    

    # (Q5C) Pie Chart of Gender
    plt.figure()
    GenderLabels = ["Male", "Female"]
    color_list = ["#cc0066", "#000066"]
    plt.pie(gender_freq, labels = GenderLabels, startangle = 90, colors = color_list)
    plt.legend(title = "Gender", loc = "lower right", bbox_to_anchor = (1.2,0.1))
    plt.savefig("gender.jpg", bbox_inches = "tight")


    # (Q5D) Pie Chart of First digit of phone number
    plt.figure()
    DigitLabels = ["6", "7", "8", "9"]
    color_list_pie = ["red", "green", "blue", "yellow"]
    plt.pie(phone_firstdig_freq, labels = DigitLabels, startangle = 90, colors = color_list_pie)
    plt.legend(title = "First Digit of Phone Number", loc = "lower right", bbox_to_anchor =(1.5,0.3))
    plt.savefig("phone.jpg", bbox_inches = "tight")


    # (Q5E) Cumulative Distribution Function of Ages (gender-wise) as Line Plots
    ages_male.sort()
    ages_female.sort()
    counter_male = Counter(ages_male)
    counter_female = Counter(ages_female)
    # this will store a dictionary of ages and their corresponding frequencies, in order of decreasing frequency
    # in the dictionaries, key = ages, value = frequency
    plt.figure()
    # input for the plot should be lists/arrays
    x_m = list(counter_male.keys())         # array of unique ages (male)
    freq_m = list(counter_male.values())    # array of frequency of ages (male)
    x_f = list(counter_female.keys())       # array of unique ages (female)
    freq_f = list(counter_female.values())  # array of frequency of ages (female)
    cdf_m = np.cumsum(freq_m)               # cdf of male ages, using freq_m array
    cdf_f = np.cumsum(freq_f)               # cdf of female ages, using freq_f array

    plt.plot(x_m, cdf_m, label="Male", color = color_list[0])
    plt.plot(x_f, cdf_f, label="Female", color = color_list[1])
    plt.xlabel("Age (yrs) --->")
    plt.ylabel("Cumulative Frequency --->")
    plt.legend(title = "CDF of Ages", loc = "lower right")

    plt.savefig("age.jpg", bbox_inches = "tight")


    # (Q5F) Bar plot for number of people living in each state
    state_list.sort()                       # sorted list of state names    
    counter_state = Counter(state_list)     # dictionary where key = state name, value = frequency
    
    plt.figure()
    unique_st = list(counter_state.keys())  # array of unique states
    freq_st = list(counter_state.values())  # array of frequency of states
    plt.bar(unique_st, freq_st, color = "#000099")
    plt.xlabel("States --->")
    plt.ylabel("Number of people from the state --->")

    # x tick labels need to be rotated
    plt.xticks(unique_st, unique_st, rotation = 45, ha = "right", fontsize = 7)
    plt.tight_layout()
    plt.savefig("state.jpg")

if __name__ == "__main__":
    main()
