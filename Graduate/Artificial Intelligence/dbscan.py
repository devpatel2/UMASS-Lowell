from sklearn import datasets, cluster, model_selection as ms, metrics, decomposition as decomp
import matplotlib.pyplot as plt
from keras.datasets import mnist
from MulticoreTSNE import MulticoreTSNE as mTSNE
import time
from sklearn.discriminant_analysis import LinearDiscriminantAnalysis as LDA

start_time = time.time()

(x_train, y_train), (x_test, y_test) = mnist.load_data()
x_train = x_train.reshape(x_train.shape[0], -1)
x_test = x_test.reshape(x_test.shape[0], -1)
# data = datasets.load_digits()
# x = data.data
# y = data.target
# x_train, x_test, y_train, y_test = ms.train_test_split(x, y, train_size=0.86)

# pca = decomp.PCA(n_components=50, copy=False, random_state=42)
# train_pca = pca.fit_transform(x_train)
# test_pca = pca.fit_transform(x_test)

ld = LDA(n_components=50)
train_pca = ld.fit_transform(x_train, y_train)
test_pca = ld.fit_transform(x_test, y_test)

n_comp = 2
tsne = mTSNE(n_components=n_comp, perplexity=40, n_iter=300, n_jobs=-1)
train_tsne = tsne.fit_transform(train_pca)
test_tsne = tsne.fit_transform(test_pca)


min_points = (50 * n_comp) + 1
# knn = neaN(n_neighbors=min_points, algorithm='kd_tree', n_jobs=-1)
# knn.fit(x_train)
# knn_graph = knn.kneighbors_graph(x_train, mode='distance')

dbscan = cluster.DBSCAN(eps=2, min_samples=min_points, n_jobs=-1, algorithm="kd_tree")
dbscan.fit(x_train)

labels = dbscan.labels_
clusters = dbscan.fit_predict(test_pca)

# print("Homogeneity: %0.3f" % metrics.homogeneity_score(np.unique(labels), np.unique(clusters)))
# print("Completeness: %0.3f" % metrics.completeness_score(np.unique(labels), np.unique(clusters)))

colors = ["#476A2A", "#7851B8", '#BD3430', '#4A2D4E', '#875525',
          '#A83683', '#4E655E', '#853541', '#3A3120', '#535D8E',
          '#020035', '#020035', '#0ffef9', '#ffff14', '#703be7', 'black']

plt.figure(figsize=(10, 10))
plt.xlim(test_pca[:, 0].min(), test_pca[:, 0].max())
plt.ylim(test_pca[:, 1].min(), test_pca[:, 1].max())
for i in range(len(y_test)):
    plt.text(test_pca[i, 0], test_pca[i, 1], str(y_test[i]),
             color=colors[clusters[i]],
             fontdict={'weight': 'bold', 'size': 9})
plt.show()
