import requests, urllib
from pprint import pprint
import io
import os
import json, ast
#from twisted.internet import task, reactor
import time

from requests.api import post
from twisted.internet.defer import timeout

# Api end-point
# URL = "https://adobe-premiere-pro-project-files.s3.us-east-2.amazonaws.com/thumbnails/target_image/thumb_1.jpg"

# # Download directory
# path_download = os.path.join(os.path.dirname(__file__), "downloads")


# def saveImgFile(resourse, filename):
#     with open(os.path.join(path_download, filename), "wb") as f:
#         f.write(resourse.read())

# def getAllObjects():
#     getURL = "https://adobe-premiere-pro-api-project.herokuapp.com/api/selectedThumbnailList"
#     #thumbStr = "thumb_"+str(i)+".jpg"
#     #fullGetURL = getURL + thumbStr
#     resp = requests.get(getURL)
#     print(resp.json())
#     if resp.status_code == 200:
#         data =resp.json()
#         thumbnails = [data[0]["selectedThumbnails"]]
#         print(thumbnails)

#     # if resp.status_code == 200:
#     #     image_bytes = io.BytesIO(resp.content)
#     #     # to save the image 
#     #     saveImgFile(image_bytes, thumbStr)


#     # resp = requests.get(get_URL)
#     # print(resp)
#     # data = resp.json()
#     # pprint(data)
#     # if data and data["statusCode"] == "200":
#     #     files = data["message"]
#     #     for file in files:
#     #         name = file["name"]
#     #         img_url = file["url"]
#     #         #img_url = img_url.replace("https:/", "https://")
#     #         response = requests.get(img_url)
#     #         image_bytes = io.BytesIO(response.content)
#     #         # to save the image 
#     #         saveImgFile(image_bytes, name)
#     # else:
#     #     raise Exception("Failed to get request to the API End-Point: \n{}".format(get_URL))

# def uploadObject(img_path, img_name):
#     post_URL = URL + "get-upload-url"
#     data = {
#         'filename': img_name,
#         'filetype': 'image/jpg'
#     }
#     resp = requests.post(post_URL, json= json.dumps(data))
#     if resp.status_code == 200:
#         # request successful 
#         post_data = resp.json()
#         signed_request = post_data["signedRequest"]
#         put_data = requests.put(signed_request, files= {'upload_file': open(img_path,'rb')})
#         if put_data.status_code == 200:
#             print("File successfully uploaded")
#         else:
#             raise Exception("Could not upload File {}".format(put_data.reason))
#     else:
#         raise Exception("No Response received from the API End-point: \n{}".format(post_URL))
        

# Download directory
script_path = os.path.abspath(__file__)
path_download = os.path.join(os.path.dirname(__file__), "downloads")

def saveImgFile(resourse, filename):
    with open(os.path.join(path_download, filename), "wb") as f:
        f.write(resourse.read())

#TODO: Check Functionality
def postGeneratedTimeline(timeline_filePath, name):
    POSTURL = "https://adobe-premiere-pro-api-project.herokuapp.com/api/postGeneratedTimeline/"

    # target_image.jpg
    videoName = name.split(".")[0]+ ".mp4"
    # files = [('file', open('report.xls', 'rb')), ('file', open('report2.xls', 'rb'))]
    #files = {'videoFileName':bytes(videoName, "utf-8"), 'videoTimeline': open(timeline_filePath, "r")}
    files = [('videoFileName', (None, bytes(videoName, "utf-8"))), ('videoTimeline',(None, open(timeline_filePath), "rb")) ]
    respone = requests.post(POSTURL, files=files)

    if respone.status_code == 200:
        print(respone.text)
        print("The Timeline Successfully Sent!")
    else:
        raise Exception("ERROR: Posting the timeline!")

#TODO: Check Functionality
def getSelectedThumbnails(data):
    """ data = [
    {
        "id": 9,
        "selectedThumbnails": "[{\"thumbnailId\":\"210\",\"thumbnailTitle\":\"thumb_0\",\"thumbnailUrl\":\"https://adobe-premiere-pro-project-files.s3.us-east-2.amazonaws.com/thumbnails/target_image/thumb_0.jpg\"},{\"thumbnailId\":\"212\",\"thumbnailTitle\":\"thumb_2\",\"thumbnailUrl\":\"https://adobe-premiere-pro-project-files.s3.us-east-2.amazonaws.com/thumbnails/target_image/thumb_2.jpg\"},{\"thumbnailId\":\"214\",\"thumbnailTitle\":\"thumb_4\",\"thumbnailUrl\":\"https://adobe-premiere-pro-project-files.s3.us-east-2.amazonaws.com/thumbnails/target_image/thumb_4.jpg\"},{\"thumbnailId\":\"215\",\"thumbnailTitle\":\"thumb_5\",\"thumbnailUrl\":\"https://adobe-premiere-pro-project-files.s3.us-east-2.amazonaws.com/thumbnails/target_image/thumb_5.jpg\"}]",
        "groupImage": 15
        }
    ]

    """
    thumbList = ast.literal_eval(data[0]["selectedThumbnails"])
    print(thumbList)
    for thumb in thumbList:
        print(thumb)
        getURL = thumb["thumbnailUrl"]
        print(getURL)
        thumbName = thumb["thumbnailTitle"]+".jpg"
        resp = requests.get(getURL)
        if resp.status_code == 200:
            image_bytes = io.BytesIO(resp.content)
            saveImgFile(image_bytes, thumbName)
        else:
            raise Exception(f"Error in getting the Thumbnail Image {thumbName} at {getURL}")
        



# TODO: Check functionality 
def getGroupImgName() -> list:
    GET_GROUP_IMG_NAME_URL = "https://adobe-premiere-pro-api-project.herokuapp.com/api/groupImageList"
    resp = requests.get(GET_GROUP_IMG_NAME_URL)
    if resp.status_code == 200:
        if len(resp.json()) > 0:
            data = resp.json()[0]
            imgTitle = data["title"]
            imgId = data["id"]
            return [imgId, imgTitle]
        else:
            return []            
    else:
        raise Exception("Error in Server connection, failed to GET files")
        
    
if __name__ == "__main__":
    THUMBNAILS_URL= "https://adobe-premiere-pro-api-project.herokuapp.com/api/getSelectedThumbnails/"
    while True:
        # id, name
        imgData = getGroupImgName()
        if len(imgData) > 0:
            completeThumbnailsUrl = THUMBNAILS_URL+imgData[1]
            print(completeThumbnailsUrl)
            thumbResp = requests.get(completeThumbnailsUrl)
            if thumbResp.status_code == 200:
                thumbData = thumbResp.json()
                getSelectedThumbnails(thumbData)
                # the selected Thumbnails are downloaded here
                # apply face recognition here
                generated_filePath = os.path.join(os.path.dirname(__file__), "generatedTimeline.json")
                postGeneratedTimeline(generated_filePath, imgData[1])
                raise Exception("DONE ONE CYCLE")
        else:
            print("No Group Photo Uploaded!!!!")
        
        time.sleep(20)
        
    # timeout = 20
    # l = task.LoopingCall(getGroupImgName())
    # l.start(timeout) 

    # reactor.run()


       
    #getAllObjects()
    #img = os.listdir(path_download)[1]
    #img_name = os.listdir(path_download)[0]
    #img_path = os.path.join(path_download, img_name)
    #uploadObject(img_path, img_name)