//Crossbrowser compatibility functions

function getAudioById(id) {
	if (document.getElementById(id).play)
	return document.getElementById(id);
	return document.getElementById(id).getElementsByTagName("embed")[0];
}

function playAudio(id) {
	if (!getAudioById(id).muted)
		getAudioById(id).play();
}

function decodeHTML(str){
	var temp=document.createElement("pre");
	temp.innerHTML=str;
	return temp.firstChild.nodeValue ? temp.firstChild.nodeValue : str;
}


//The rest of the code

msgReq = new XMLHttpRequest(); // TODO: handle unsupported fallback
onlReq = new XMLHttpRequest();
renewReq = new XMLHttpRequest();


// Output the messages list
function setMessages() {
	if (msgReq.readyState === 4 && msgReq.status === 200) {

		var m_old = parseInt(document.getElementById("n-messages").innerHTML);

		obj = JSON.parse(msgReq.responseText);

		if (obj.newmgs === "overload")
			self.location.reload();

		else if (obj.newmsg) {

			document.getElementById("n-messages").innerHTML = parseInt(document.getElementById("n-messages").innerHTML) + obj.newmsg;

			var msgList = document.getElementById("messages");
			var canScroll = (msgList.scrollHeight - msgList.scrollTop) <= 320;
			var scrolled = msgList.scrollTop;

			msgList.innerHTML += obj.content;

			msgList.scrollTop = scrolled;

			if (canScroll)
				msgList.scrollTop = msgList.scrollHeight;

			var m_new = parseInt(document.getElementById("n-messages").innerHTML);

			if (m_new > m_old) {
				playAudio("new-msg");
				if (canScroll === 0)
					document.getElementById("skip").style.display = "block";
				parent.postMessage("NewMsg:"+(m_new - m_old), "*");
			}
		}
	}
}

// Output the online users list
function setOnlines() {
	if(onlReq.readyState === 4 && onlReq.status === 200) {

		var obj = JSON.parse(onlReq.responseText);

		var o_old = parseInt(document.getElementById('users-online').innerHTML);

		var onlList = document.getElementById("online");

		onlList.innerHTML = obj.content;

		var o_new = parseInt(document.getElementById('users-online').innerHTML);

		if (o_new > o_old) playAudio("new-user");
		if (o_new < o_old) playAudio("exit-user");
		parent.postMessage("Users:"+o_new, "*");
	}
}

// Post message writed
function doPost() {
	var message = document.getElementById("msg").value.replace(/^\s+/, "");
	if (message !== "") {

		var n = document.getElementById("n-messages");
		n.innerHTML = parseInt(n.innerHTML)+1;

		var objDiv = document.getElementById("messages");
		var par = document.createElement("p");
		par.setAttribute("class", "delivering");
		par.innerHTML = '<span class="name">... </span><span class="txt"><![CDATA['+message+']]></span>';
		objDiv.appendChild(par);
		objDiv.scrollTop = objDiv.scrollHeight;
		var inpObj = document.getElementById("msg");
		inpObj.value = "";
		inpObj.focus();

		playAudio("send-msg");

		var postReq = new XMLHttpRequest();
		var link = "./actions/write.php";
		var vars = "nick="+encodeURIComponent(nickName)+"&msg="+encodeURIComponent(message);
		postReq.open("POST", link , true);
		postReq.onreadystatechange = function() {
			if (postReq.readyState === 4 && postReq.status === 200) {
				var obj = JSON.parse(postReq.responseText);
				par.removeAttribute("class");
				par.outerHTML = obj.content;
				objDiv.scrollTop = objDiv.scrollHeight;
			}
		};
		postReq.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		postReq.send(vars);
	}
}

// Reloading request
function doReload() {
	var randomnumber = Math.floor(Math.random()*10000);
	var msg = document.getElementById("n-messages").innerHTML;
	var online = document.getElementById("users-online").innerHTML;
	var msgLink = './actions/get_messages.php?msg='+msg+'&rnd='+randomnumber;
	var onlLink = './actions/get_users.php?rnd='+randomnumber;
	msgReq.open("GET", msgLink , true);
	msgReq.onreadystatechange = setMessages;
	msgReq.send();
	onlReq.open("GET", onlLink, true);
	onlReq.onreadystatechange = setOnlines;
	onlReq.send();
}

function UpdateTimer() {
	doReload();
	timerAll = setTimeout(UpdateTimer, timeAll*1000);
}

//Renew the session
function doRenew() {
	var randomnumber = Math.floor(Math.random()*10000);
	var link="./actions/renew_usr.php?";
	link += "nick="+encodeURIComponent(nickName);
	link += "&audio="+document.getElementById("muteSound").checked;
	link += "&rnd="+randomnumber;
	renewReq.open("GET", link, true);
	renewReq.onreadystatechange=function(){
		if (renewReq.readyState === 4 && renewReq.status === 200) {
			var obj = JSON.parse(renewReq.responseText);
			if (obj.status === "done" && obj.action === "newdata") init(obj.newData);
			else if (obj.status === "fail") {
				switch(obj.action) {
					case "namerequired":
					case "alreadylogged":
						document.cookie="logged=0";
						self.location.href="?logout=1&"+obj.action+"=1";
					break;
					case "notlogged":
						self.location.href="?logout=1";
				}
			}
		}
	};
	renewReq.send();
	timerRenew = setTimeout("doRenew()", timeRenew*1000);
}

function changeName() {
	var oldn = encodeURIComponent(nickName);
	var newn = encodeURIComponent(document.getElementById("inputNewName").value);
	var link = "user.php?do=changename&oldnick="+oldn+"&newnick="+newn;
	location.href = link;
}

function keypressed(e){
	if (e.keyCode === 13) {
		doPost();
		return false;
	}
}

function muteSound(check) {
	var a = getAudioById("new-msg");
	var b = getAudioById("send-msg");
	var c = getAudioById("new-user");
	var d = getAudioById("exit-user");

	var anno = new Date();
	anno.setFullYear(anno.getFullYear() +1);
	var etc = " expires=" + anno.toGMTString();

	if (check.checked) { a.muted=1; b.muted=1; c.muted=1; d.muted=1; document.cookie="muteSound=true;"+etc; }
	else { a.muted=0; b.muted=0; c.muted=0; d.muted=0; document.cookie="muteSound=false;"+etc; }
}

function inpWrite(val) {
	var input = document.getElementById("msg");
	input.value += val;
	input.focus();
}

function inpFormat(type) {
	var format;
	switch(type) {
		case "b":
			format = "grassetto"; break;
		case "i":
			format = "corsivo"; break;
		case "u":
			format = 'sottolineato'; break;
	}

	dialog({
		type: "prompt",
		title: "Formattazione guidata",
		content: "Inserisci il testo da formattare in "+format,
		callback: inpFormat2,
		vars: { t: type }
	});
}

function inpFormat2(o) {
	var input = document.getElementById("msg");
	if (o.action && o.value !== "") {
		input.value += "[" + o.vars.t + "]" + o.value + "[/" + o.vars.t + "]";
		input.focus();
	}
}

function inpLink(obj) {
	var input = document.getElementById("msg");
	obj = obj || new Object();

	if (typeof obj.id === "undefined")
		dialog({
			type: "prompt",
			title: "Formattazione guidata",
			content: "Inserisci il link della pagina web (includi anche http://)",
			placeholder: "http://",
			id: "link",
			callback: inpLink
		});

	else if (obj.id === "link" && obj.value !== "" && obj.action)
		dialog({
			type: "prompt",
			title: "Formattazione guidata",
			content: "Inserisci il testo da visualizzare (facoltativo)",
			id: "txt",
			callback: inpLink,
			vars: {link: obj.value}
		});

	else if (obj.id === "txt" && obj.action) {
		var txt  = obj.value;
		var link = obj.vars.link;
		if (txt !== "") input.value += '[url='+link+']'+txt+'[/url]';
		else input.value += '[url]'+link+'[/url]';
		input.focus();
	}
}

function skipBT() {
	document.getElementById("skip").style.display="none";
	var a = document.getElementById("messages");
	a.scrollTop=a.scrollHeight;
}

function checkBtn(div) {
	var btn = document.getElementById("skip").style;
	if ((div.scrollHeight-div.scrollTop) <= 320 && btn.display === "block")
		btn.display = "none";
}

function init(req) {
	//FIX AUDIO PLAYING ON iDEVICES
	if ('ontouchstart' in document.documentElement) {
		loaded = 0;
		function loadAudios() {
			switch (loaded) {
				case 0: getAudioById("new-msg").load(); break;
				case 1: getAudioById("new-user").load(); break;
				case 2: getAudioById("exit-user").load();
				document.body.removeEventListener("touchstart", loadAudios, true); break;
			}
			loaded++;
		}
		document.body.addEventListener("touchstart", loadAudios, true);
	}

	if (typeof req === "object") {
		nickName = req.nickName;
		document.getElementById("muteSound").checked = req.muteSound;
	}
	else {
		cont = document.getElementById("messages");
		cont.scrollTop = cont.scrollHeight;
	}
	document.getElementById("nick").innerHTML = nickName;
	document.getElementById("inputNewName").value = decodeHTML(nickName);
	muteSound(document.getElementById("muteSound"));
}

parent.postMessage("Users:Offline", "*");
parent.postMessage("NewMsg:-", "*");
