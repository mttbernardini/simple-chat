# simple-chat: a minimal PHP chatroom #

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/69298e5725ae45e983167175ab365a1c)](https://www.codacy.com/app/mttbernardini/simple-chat?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=mttbernardini/simple-chat&amp;utm_campaign=Badge_Grade)

A simple chatroom developed in PHP (using [Micro Chat][1] as template) with no authentication (only a not chosen nickname is needed to login) and without a database (messages and status are stored in xml files). Also, the message fetching is polling based (no instant messaging, expect a delay of some seconds).

This is the first project I actually learned to program with (I was 14) and it was conceived as a chatroom for my classmates (You might find references in early commits).

As a result, the source code is pretty messy and illegible. My intention is to enhance it and generalize everything in the hope of making this project (or part of it) useful for someone.

----------------

&copy; 2011 Matteo Bernardini, [@mttbernardini][2].

This project is licensed under the Apache License 2.0.  
Please refer to the LICENSE file for further information.


[1]: http://www.phptoys.com/product/micro-chat.html
[2]: https://twitter.com/mttbernardini
