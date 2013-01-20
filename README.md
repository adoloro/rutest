RUN translation website uses Codeigniter framework for PHP which implements model-view-controller architecture pattern.

We have the following models:

1. Test - where we store information about each test we have in the system. 
This model can:
- whether user is allowed to see his test results 
- check whether test number is valid (before trying to fetch non-existant tests)
- get all the tests (by default sorted by level of tests)

2. Permissions  - stores information about permissions for different users.
There are two types of permissions: "Allowed to take the test" and "allowed to see the results"
Permissions are created separately for each user to allow a fine-grained control.
Permissions should be synchronized 
