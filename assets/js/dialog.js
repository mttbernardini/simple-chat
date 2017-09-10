/*
 * dialog.js is a utility which can replace the default JavaScript dialog windows for webpages (alert(), prompt(), confirm())
 *
 * Version: 3.0
 * Copyright (c) 2015 Matteo Bernardini
 * Licensed under the MIT License (refer to the LICENSE file for further information).
 *
 * Check this project on GitHub:
 * https://github.com/mttbernardin/dialog
 *
 */


"use strict";

var dialogSettings = new Object();

function dialog(params) {

	params         = params         || new Object();
	dialogSettings = dialogSettings || new Object();

	// == Default Values == //
	dialogSettings.defTitle     =  dialogSettings.defTitle      ||  "Message";
	dialogSettings.defType      =  dialogSettings.defType       ||  "alert";
	dialogSettings.defContent   =  dialogSettings.defContent    ||  "Missing text";
	dialogSettings.okText       =  dialogSettings.okText        ||  "OK";
	dialogSettings.continueText =  dialogSettings.continueText  ||  "Continue";
	dialogSettings.cancelText   =  dialogSettings.cancelText    ||  "Cancel";

	// == Switch between default values or passed values == //
	params.title    =  params.title    ||  dialogSettings.defTitle;
	params.type     =  params.type     ||  dialogSettings.defType;
	params.content  =  params.content  ||  dialogSettings.defContent;


	// == Creating elements == //
	var parts = ["window", "wrapper", "title", "body", "message", "prompt", "actions", "ok-btn", "cancel-btn"],
	    elms  = {};

	for (var i = 0, partName; partName = parts[i]; i++) {
		if (partName.indexOf("btn") !== -1) {
			elms[partName] = document.createElement("button");
			elms[partName].setAttribute("type", "button");
		} else {
			elms[partName] = document.createElement("div");
		}
		elms[partName].className = "dialog-" + partName;
	}

	var prompt = document.createElement("input");
	prompt.setAttribute("type", "text");
	prompt.className = "dialog-prompt-input";


	// == Arranging elements == //
	elms["window"].appendChild(elms["wrapper"]);
	elms["wrapper"].appendChild(elms["title"]);
	elms["wrapper"].appendChild(elms["body"]);
	elms["body"].appendChild(elms["message"]);
	elms["actions"].appendChild(elms["ok-btn"]);

	switch (params.type) {
		case "prompt":
			elms["prompt"].appendChild(prompt);
			elms["body"].appendChild(elms["prompt"]);
		case "confirm": // or "prompt", notice no break here
			elms["actions"].appendChild(elms["cancel-btn"]);
	}

	elms["body"].appendChild(elms["actions"]);


	// == Assigning values == //
	elms["title"].textContent       =  params.title;
	elms["message"].textContent     =  params.content;
	elms["ok-btn"].textContent      =  params.type === "confirm" ? dialogSettings.continueText : dialogSettings.okText;
	elms["cancel-btn"].textContent  =  dialogSettings.cancelText;
	prompt.placeholder              =  params.placeholder || "";


	// == Appending to body & focus == //
	var dialogWindow = elms["window"];
	dialogWindow.setAttribute("data-dialog-type", params.type);

	document.body.appendChild(dialogWindow);

	if (params.type === "prompt")
		prompt.focus();



	// == Return promise == //
	return new Promise(function(resolve, reject) {

		// Will be triggered when closing the dialog
		function action(e, userAction) {
			e = e || window.event;
			var target = e.target ? e.target : e.srcElement;

			if (typeof userAction === "boolean" || target.tagName.toLowerCase() === "button") {
				document.removeEventListener("keyup", useKeys, false);
				document.body.removeChild(dialogWindow);
				resolve({
					id:     params.id,
					action: typeof userAction === "boolean" ? userAction : target.className.indexOf("ok") !== -1,
					value:  params.type === "prompt" ? prompt.value : void 0,
					data:   params.data
				});
			}
		}

		// Handler for keyboard events
		function useKeys(e) {
			e = e || window.event;
			if (e.keyCode === 13) // ENTER key
				action(null, true);
			else if (e.keyCode === 27 && params.type !== "alert") // ESC key
				action(null, false);
		}

		document.addEventListener("keyup", useKeys, false);
		elms["actions"].addEventListener("click", action, false);

	});
}
