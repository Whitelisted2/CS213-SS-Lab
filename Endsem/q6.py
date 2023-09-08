from collections import Counter
import matplotlib.pyplot as plt
import numpy as np
from random import shuffle
import collections

class pininfo:
    def __init__(self, pin, district, state):
        self.pin = int(pin)
        self.district = str(district)
        self.state = str(state)

def main():

    all_info = []              # To store all the dataas an array/list of objects
    infile = open("pincode_dataset.txt", "r")
    count = 0
    for line in infile:
        if count == 0:
            count = 1
            continue
        info_from_line = line.split(", ")
        all_info.append(pininfo(info_from_line[0], info_from_line[1], info_from_line[2]))
    infile.close()

    state_list = []           # To store all state names, with repetition
    district_list = []        # To store all district names, with repetition

    # Since the pincodes are unique in the file, our job becomes marginally easier
    # since number of pincodes in some state X is the number of lines that have state X
    # i.e. the number of objects with state X.

    flag=0
    for instance in all_info:
        if(instance.state == "West Bengal"):
            flag=1
            continue
        if(instance.state == "West Bengal" and flag == 1):
            continue
        state_list.append(instance.state)         # get all the states info from all objects
        district_list.append(instance.district)   # also the districts, for later
    
    state_list.sort()                         # for convenience
    district_list.sort()
    state_counter = Counter(state_list)
    district_counter = Counter(district_list)


    unique_states = list(state_counter.keys())
    freq_states = list(state_counter.values())
    
    plt.figure(figsize=[10,10])
    
    plt.pie(freq_states, labels=unique_states, startangle = 0, labeldistance=1.02, rotatelabels=True)
    plt.legend( labels=unique_states, title = "Number of pincodes in each Indian state", borderpad=0.6,
    title_fontsize="xx-large", bbox_to_anchor = (1.1,0.95), ncol=3, fontsize="large")

    plt.savefig("pincodepiechart.jpg", bbox_inches = "tight")
    
    dist_max = max(zip(district_counter.values(), district_counter.keys()))[1]
    
    for instance in all_info:
        if instance.district == dist_max:
            state_max = instance.state
            break

    print("State containing district with most pin codes is: " + state_max)
    print("District that contains max pincodes is: " + dist_max)

if __name__ == "__main__":
    main()