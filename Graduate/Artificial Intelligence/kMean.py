from sklearn import datasets, cluster, model_selection as ms, metrics, decomposition as decomp
import matplotlib.pyplot as plt
import numpy as np
from keras.datasets import mnist
from scipy.stats import mode
from sklearn.manifold import TSNE
from MulticoreTSNE import MulticoreTSNE as mTSNE
from sklearn.discriminant_analysis import LinearDiscriminantAnalysis as LDA

# X, y = datasets.fetch_openml(name='mnist_784', version=1, return_X_y=True)
(x_train, y_train), (x_test, y_test) = mnist.load_data()
x_train = x_train.reshape(x_train.shape[0], -1)
x_test = x_test.reshape(x_test.shape[0], -1)
# data = datasets.load_digits()
# x = data.data
# y = data.target
# x_train, x_test, y_train, y_test = ms.train_test_split(x, y, train_size=0.86)

# random_start = 0 or 42
# pca = decomp.PCA(n_components=50, copy=False)
# train_pca = pca.fit_transform(x_train)
# test_pca = pca.fit_transform(x_test)

ld = LDA(n_components=50)
train_pca = ld.fit_transform(x_train, y_train)
test_pca = ld.fit_transform(x_test, y_test)

b_size = 10000
# inc_pca = decomp.IncrementalPCA(n_components=50, copy=False, batch_size=b_size)
# train_pca = inc_pca.fit_transform(x_train)
# test_pca = inc_pca.fit_transform(x_test)

# tsne = TSNE(n_components=2, perplexity=40, n_iter=300, random_state=42)
# train_tsne = tsne.fit_transform(train_pca)
# test_tsne = tsne.fit_transform(test_pca)

tsne = mTSNE(n_components=2, perplexity=40, n_iter=300, n_jobs=-1)
train_tsne = tsne.fit_transform(train_pca)
test_tsne = tsne.fit_transform(test_pca)

# kmeans = cluster.KMeans(n_clusters=10, n_jobs=-1, algorithm="full")
# kmeans.fit(x_train)

kmeans = cluster.MiniBatchKMeans(n_clusters=10, max_iter=300, batch_size=b_size).fit(train_tsne)

test_predict = kmeans.fit_predict(test_tsne)
labels = np.zeros_like(test_predict)
for i in range(10):
    mask = (test_predict == i)
    labels[mask] = mode(y_test[mask])[0]
test_acc = metrics.accuracy_score(y_test, labels)
print(test_acc)

colors = ["#476A2A", "#7851B8", '#BD3430', '#4A2D4E', '#875525',
          '#A83683', '#4E655E', '#853541', '#3A3120', '#535D8E',
          '#020035', '#020035', '#0ffef9', '#ffff14', '#703be7', 'black']

plt.figure(figsize=(10, 10))
plt.xlim(test_tsne[:, 0].min(), test_tsne[:, 0].max())
plt.ylim(test_tsne[:, 1].min(), test_tsne[:, 1].max())
for i in range(len(y_test)):
    plt.text(test_tsne[i, 0], test_tsne[i, 1], str(y_test[i]),
             color=colors[test_predict[i]],
             fontdict={'weight': 'bold', 'size': 9})
plt.show()
