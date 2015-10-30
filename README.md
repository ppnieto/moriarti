# moriarti
php message oriented microarchitecture

# Motivation
Moriarti try to avoid calls between modules. Main goal is each module only do what have to do, maximizing cohesion and minimizing coupling.
The way to do this is with messages, following SOA principles. Every time a module needs inform to other modules, send a message. Every time a module needs to listen what happens in other modules, listen for message. Thus, messages are used to replace intermodule calls and events.


