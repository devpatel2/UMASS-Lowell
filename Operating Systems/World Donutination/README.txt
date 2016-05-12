This program demonstrates a producer-consumer network. The producer makes donuts and consumers eat them by the dozens.

The program will receive the following command-line arguments: PC (a producer count), PM (a production mode), DC (donut type count), CC (a consumer count), DDC (a donut dozen count), and QS (a queue size).

The producer process should endlessly produce donuts. If PM is in-order, it should produce one donut of each of the DC types in sequence. If PM is rand, it should randomly determine which type of donut to produce. In this context, to produce donut #n of type ty means to put the integer n into the queue for type ty.

The consumer processes should consume DDC dozen donuts. To consume a donut of type ty means to read the integer at the next slot in the queue for type ty. When consumer i finishes consuming dozen j, the consumer should display a line formatted as (yum i j ([ty di] ...)) where ty is the donut type and di is the donut identifier. Your consumers should consume donuts in an order determined by PM in the same way as producer (i.e. ordered or randomized).