#EDLARA2


This is a major rewrite of the Edlara Version 1.

In this version we integrate the solution with complex structure which gives more modularity to the system. The solution uses Orchestra Platform as base instead of plain "Laravel 4" as used in version 1.

Current Plans
-------------

We will try to use a Graph Database solution to build up a Knowledge Engine. and Document Oriented DB solution to record very large documents and keeping somethings off the corner of MySQL and Graph.

The System will use MySQL as fallback for anything that aroses problem for storage. The MySQL DB interfaces will provide fallbacks when necessary and system will include migrations for fallbacks. The fallbacks will be triggered once when there is no solution available. The Fallback data will be able to migrate to real locations through provided settings.
