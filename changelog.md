# Changelog of *simple-chat* #

## Version 3 ##

### 3.1 ###

- Introduced an internal logging system for events like logins, logouts, sent messages and expired sessions.
- Optimized sources organization and file protections.
- Minor improvements.

### 3.0 ###

- Messages and online users are stored in XML files.
- Server-client communication is done using JSON.
- The front-end is now in XHTML5, thus page load and rendering are faster.
- Dropped Latin 1 encoding (ISO-8859-1), now everything is in Unicode (UTF-8).
- Smart date/time grouping in messages: time is shown every 30min or when between two messages there are more than 2min.
- The chat is fully multi-session: every action in one instance is applied to other instances (except for login).
- GUI improvements: message date is shown on the right, bigger title, buttons have a 3D aspect.
- Consecutive messages by a single user are grouped (following messages are prefixed with an ellipsis).
- The chat only shows the last 120 messages. Older messages are archived and visible on a separate [history page][history].
- If AJAX is not supported in the browser an error message is shown and the chat is not available.
- Minor bugfixes.


## Version 2 ##

### 2.1 ###

- Fixed a bug with character encoding in nickname and messages.
- Fixed "skip to bottom" button positioning.
- Minor bugfixes.

### 2.0 ###

- Unified HTML5 version for all browsers.
- Online users are managed via expiring sessions (fixes bug with persistent online users).
- Added option to remember nickname at login.
- Added option to autologin.
- Login fails if the nickname is already in use.
- Added a "settings" section to change nickname and disable sounds.
- Settings are now persistent (via cookies).
- Guided formatting is now done via dialog boxes (using [dialog.js][dialog]).
- Outcoming messages are semitransparent on IE too.
- Minor bugfixes and performance improvements.


## Version 1 ##

### 1.1 ###

- Rewrote code from scratch, more organized and faster.
- Renewed GUI with brighter colors and rounded edges (depending on browser support).
- Messages are refreshed only if necessary, online list is refreshed every 3 seconds.
- Unified JS code for all browsers (in future the HTML part will be unified too).
- Minor improvements and bugfixes.

### 1.0 ###

- First version
- Created a separate HTML 4.01 version for IE and a HTML 5 version for other browsers.
- Fixed bug with messages and online users list refreshing.
- Enhanced general performance and speed.
- Partially fixed bug that keeps an offline user in the online list.
- Set a 20 characters limit for the nickname.
- Added date and time grouping in the message list.
- Outcoming messages are semitransparent until received by the server (not compatible with IE).
- Send formatted text and links in BBCode syntax.
- Added guided formatting.
- Minor bugfixes.


## Alpha ##

- Created chat using [Micro Chat][micro-chat] as template.
- Added sounds for incoming and sent messages.
- Fixed a bug which caused login not to work properly.
- Added a line to display the nickname ad a logout button.
- Added session persistence using cookies.
- Added option to change nickname.
- Fixed a bug that allowed to send empty messages.
- Added list of online users and sounds to login/logout events.
- Added emoticons.
- Added feature to send formatted text and links.
- Added option to disable sounds.
- Fixed a bug which caused an automatic scroll to the bottom on the message list.
- Added a button to manually scroll to the bottom when a new message arrives.
- Took down the chat for numerous bugs.


[micro-chat]: http://www.phptoys.com/product/micro-chat.html
[dialog]: https://github.com/mttbernardini/dialog
[history]: history.php
