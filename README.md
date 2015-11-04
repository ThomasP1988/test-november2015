# test-november2015
********** wants a simple program to be written that searches its database of vendors for food packages available given day, time, location and a number of covers. Each vendor has a name, postcode and a maximum number of covers it can serve at any time. Food packages provided by vendors each have a name, a list of allergies and the advance time needed for ordering the package.

Your task is to write a console application that takes four input parameters:

    filename - input file with the vendors data
    day      - delivery day (dd/mm/yy)
    time     - delivery time in 24h format (hh:mm)
    location - delivery location (postcode without spaces, e.g. NW43QB)
    covers   - number of packages
    
and prints a list of package names (and package-related allergens) available for order given the following rules:

    1. package vendor must be in the delivery area, e.g. vendor with a postcode starting "NW" can only deliver to a postcode starting with "NW", etc.
    2. vendor must be able to serve the requested number of covers
    3. package advance time must be less or equal to the difference between the search time and the actual time of the delivery

The input file is provided in the following EBNF-like text format:
    
    vendors      = { vendor, new line, packages, new line } EOF
    vendor       = name, ";", postcode, ";", max covers
    packages     = { package, new line }
    package      = name, ";", allergies, ";", advance time
    name         = /[A-Za-z ]*/
    postcode     = /[A-Za-z][A-Za-z0-9]*/
    max covers   = /\d*/
    advance time = /\d\dh/
    new line     = "\r\n"

Here's an example input file:

    Grain and Leaf;E32NY;100
    Grain salad;nuts;12h

    Wholegrains;SW34DA;20
    The classic package;gluten;24h

    Ghana Kitchen;NW42QA;40
    Premium meat selection;;36h
    Breakfast;gluten,eggs;12h

    Well Kneaded;EC32BA;150
    Full English breakfast;gluten;24h
    

Calling the application with the above input on 20/10/15 at 12 AM and the parameters "input 21/10/15 11:00 NW43QB 20" would print the following lines:

    Breakfast;gluten,eggs
    
Or, calling the application with the above input on 20/10/15 at 12 AM and the parameters "input 24/10/15 11:00 NW43QB 20" would print the following lines:

    Premium meat selection;;
    Breakfast;gluten,eggs
    

Structure your code as if this was a real, production application. You may however choose to provide simplified implementations for some aspects (e.g. in-memory persistence instead of a full database, if you think any persistance is required at all).

State any assumptions you make as comments in the codebase. If any aspects of the above specification is unclear then please also state, as comments in the source, your interpretation of the requirement.

The purpose of the exercise is to evaluate your approach to software development covering among other things elements of Object Oriented Design, Software Design Patterns and Testing. This exercise is not time bounded.

Complete the exercise in PHP. You are free to implement any mechanism for feeding input into your solution (for example, using hard coded data within unit test). You should provide sufficient evidence that your solution is complete by, as a minimum, indicating that it works correctly against the supplied test data.
