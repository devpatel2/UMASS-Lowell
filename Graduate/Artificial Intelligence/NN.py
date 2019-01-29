from sklearn import datasets, model_selection as ms, metrics, preprocessing as pre
from sklearn import neural_network as nn
from keras.datasets import mnist

(x_train, y_train), (x_test, y_test) = mnist.load_data()
x_train = x_train.reshape(x_train.shape[0], -1)
x_test = x_test.reshape(x_test.shape[0], -1)
# data = datasets.load_digits()
# x = data.data
# y = data.target
# x_train, x_test, y_train, y_test = ms.train_test_split(x, y, train_size=0.86)

scaler = pre.StandardScaler()
scaler.fit(x_train)
x_train = scaler.transform(x_train)
x_test = scaler.transform(x_test)

nn_clf = nn.MLPClassifier(hidden_layer_sizes=(128, 128), activation='logistic', solver='adam', batch_size=10000)
nn_clf.fit(x_train, y_train)

test_pred = nn_clf.predict(x_test)
print(metrics.accuracy_score(y_test, test_pred))
print(metrics.confusion_matrix(y_test, test_pred))
