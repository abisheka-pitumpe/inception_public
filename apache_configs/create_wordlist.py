#import

import os, sys
import random
import requests
import json

def get_rand_text(paragraphs, wordsperparafrom, wordsperparato):
    #curl http://www.randomtext.me/download/txt/gibberish/p-9/10-25
    url = 'http://www.randomtext.me/download/txt/gibberish/p-{}/{}-{}'.format(paragraphs, wordsperparafrom, wordsperparato)
    response = requests.get(url)
    html_content = response.text
    html_content = str(html_content).replace("\r\n", "\n").strip()
    return html_content


def create_ipdictjson():
    #use it only once for generating encode file.
    ipdict1=[]
    ipdict2=[]
    ipdict3=[]
    ipdict4=[]

    isFull = False
    while(isFull == False):
        randlongtext = get_rand_text(1, 1000, 1000).replace(".", "")    #get a 1024 length word list
        wordlist = randlongtext.split(' ')
        print(len(wordlist))
        for word in wordlist:
            if(word not in ipdict1 and word not in ipdict2 and word not in ipdict3 and word not in ipdict4 and len(ipdict1) < 256):
                ipdict1.append(word)
            elif (word not in ipdict1 and word not in ipdict2 and word not in ipdict3 and word not in ipdict4 and len(ipdict2) < 256):
                ipdict2.append(word)
            elif (word not in ipdict1 and word not in ipdict2 and word not in ipdict3 and word not in ipdict4 and len(ipdict3) < 256):
                ipdict3.append(word)
            elif (word not in ipdict1 and word not in ipdict2 and word not in ipdict3 and word not in ipdict4 and len(ipdict4) < 256):
                ipdict4.append(word)
        print("Exhausted one list.")
        print("ip1:{} ip2:{} ip3:{} ip4:{}".format(len(ipdict1),len(ipdict2),len(ipdict3),len(ipdict4)))
        if ((len(ipdict1) >= 256) and (len(ipdict2) >= 256) and (len(ipdict3) >= 256) and (len(ipdict4) >= 256)):
            isFull = True
            print("finished creating encoding.")

    encode_dict = {}
    encode_dict["ip1"] = ipdict1
    encode_dict["ip2"] = ipdict2
    encode_dict["ip3"] = ipdict3
    encode_dict["ip4"] = ipdict4

    jsonstr = json.dumps(encode_dict, sort_keys=True)
    savedir = "/home/lxg/projects/web-bot-project/apache_configs/fpcodes_gen/ipdict.json"
    with open(savedir, "w") as fp:
        fp.write(jsonstr)
        print("saved to {}".format(savedir))
    return

create_ipdictjson()