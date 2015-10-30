# moriarti
php message oriented microarchitecture

# Motivation
Moriarti try to avoid calls between modules. Main goal is each module only do what have to do, maximizing cohesion and minimizing coupling.
The way to do this is with messages, following SOA principles. Every time a module needs inform to other modules, send a message. Every time a module needs to listen what happens in other modules, listen for message. Thus, messages are used to replace intermodule calls and events.

# Name

Moriarti is an acronym for 'Message ORIented ARTchItecture'

# Simple

Sending a message

	new Message("/http/GET/index.html");	
	new Message("/bd/query/validateLogin",[':name'=>$user,':password'=>$pass]);	
	new Message("/on/exception",$exception);
	new Message("/app/invoice/new",$invoice);
	
Listen for messages
	
	Moriarti::register(3,'/app/invoice/*, function($code,$data) {  // 3 -> subscription priority
		// Listen all invoice events
	});
	
	Moriarti::register(3,'/http/*, function($code,$data) {
		// Listen all HTTP request
	}
	




