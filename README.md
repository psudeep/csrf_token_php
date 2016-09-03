# csrf_token_php
How to implement CSRF token in php

#####Steps:
+ Function CSRF() generates random encoded value which will be used as token
+ When request method is GET and form is rendered add a hidden field with CSRF value created.
+ During this GET request set session where token is set and host is set
+ On form Submit verfiy posted token with that token set in SESSION variable and verify host of referer and host set in SESSION variable.
+ If these 2 conditions matches then the chances of CSRF breach is minimal.

#####This way attack can be prevented during form submission.
