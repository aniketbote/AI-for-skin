#1st method

#import cv2
#import numpy as np

#img = cv2.imread("abcd.jpg")

#alpha = 2.0
#beta = -160

#new = alpha * img + beta
#new = np.clip(new, 0, 255).astype(np.uint8)

#cv2.imwrite("cleaned.png", new)


#2nd:
import numpy as np
import cv2 as cv
img = cv.imread('abcd.jpg')
mask = cv.imread('masked.jpg',0)
dst = cv.inpaint(img,mask,3,cv.INPAINT_TELEA)
cv.imwrite('cleaned.jpg',dst)
