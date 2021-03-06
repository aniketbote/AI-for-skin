# -*- coding: utf-8 -*-
"""Copy of skin_disease_NASNetLarge.ipynb

Automatically generated by Colaboratory.

Original file is located at
    https://colab.research.google.com/drive/14ukMjERgum2IJNORxP5DLi-hmAgvGGRs
"""

from google.colab import drive
drive.mount('/content/gdrive')

!unzip '/content/gdrive/My Drive/Syrus/train_test.zip'

import pandas as pd
import numpy as np
import os
import keras
import matplotlib.pyplot as plt
from keras.layers import Dense,GlobalAveragePooling2D
from keras.applications.inception_v3 import InceptionV3
#from keras.applications.vgg19 import VGG19
from keras.preprocessing import image
from keras.applications.inception_v3 import preprocess_input
#from keras.applications.vgg19 import preprocess_input
from keras.preprocessing.image import ImageDataGenerator
from keras.models import Model
from keras.optimizers import Adam
from keras.optimizers import SGD
import tensorflow as tf

base_model = InceptionV3(weights='imagenet', include_top=False)

x=base_model.output
x=GlobalAveragePooling2D()(x)
x=Dense(1024,activation='relu')(x)
#x=GlobalAveragePooling2D()(x)
#x=Dense(1024,activation='relu')(x) 
x=Dense(256,activation='relu')(x) 
preds=Dense(23,activation='softmax')(x)

model=Model(inputs=base_model.input,outputs=preds)

for i,layer in enumerate(model.layers):
  print(i,layer.name)

for layer in model.layers[:197]:
    layer.trainable=False
for layer in model.layers[197:]:
    layer.trainable=True

train_datagen=ImageDataGenerator(preprocessing_function=preprocess_input)

train_generator=train_datagen.flow_from_directory('/content/train_test/train/',
                                                 color_mode='rgb',
                                                 batch_size=17,
                                                 class_mode='categorical',
                                                 shuffle=True)

checkpoint_path = "/content/gdrive/My Drive/Syrus/weights_inception_full/cp-{epoch:04d}.ckpt"
checkpoint_dir = os.path.dirname(checkpoint_path)


# Create checkpoint callback
cp_callback = tf.keras.callbacks.ModelCheckpoint(
    checkpoint_path, verbose=1, save_weights_only=True,
    # Save weights, every 5-epochs.
    period=5)

sgd = SGD(lr=0.01, decay=1e-6, momentum=0.9, nesterov=True)
model.load_weights('/content/gdrive/My Drive/Syrus/weights_inception_full/cp-0030.ckpt')
model.compile(optimizer=sgd,loss='categorical_crossentropy',metrics=['accuracy'])
#model.compile(optimizer='Adam',loss='categorical_crossentropy',metrics=['accuracy'])
step_size_train=train_generator.n//train_generator.batch_size
model.fit_generator(generator=train_generator,
                   steps_per_epoch=step_size_train,
                   callbacks = [cp_callback],
                   epochs=10000)

import os
from keras.utils import to_categorical
from collections import Counter
from sklearn.metrics import accuracy_score
final=[]
data = pd.read_csv('/content/gdrive/My Drive/Syrus/nayatest.csv')
df = pd.DataFrame(data,index = None)
name_list = list(df['name'])
target_list = list(df['target'])

name_list, target_list = zip(*sorted(zip(name_list, target_list)))
#print(name_list)
#print(target_list)
y_true = list(target_list)
print(y_true)


model.load_weights('/content/gdrive/My Drive/Syrus/weights_inception_full/cp-0030.ckpt')
path_test='/content/train_test/test'
for names in sorted(os.listdir(path_test)):
  print(names)
  img = image.load_img(os.path.join(path_test,names), target_size=(224, 224))
  x = image.img_to_array(img)
  x = np.expand_dims(x, axis=0)
  x = preprocess_input(x)
  preds = model.predict(x)
  #print('Predicted:')
  #print(preds)
  y_classes = preds.argmax(axis=-1)
  print(y_classes)
 
  final.append(y_classes[0])
print(final)

score = accuracy_score(y_true, final)
print(score)

!pip install h5py
!pip install tensorflowjs

model.save('inception_v3_1.h5')

!mkdir model100
!tensorflowjs_converter --input_format keras inception_v3_1.h5 model100/

!zip -r model100.zip model100

from google.colab import files
files.download('model100.zip')