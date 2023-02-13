DRPG Coding Test

This is the Laravel coding test to assess your skills and thought process when coming to build features in an application.

Please send any questions you have through to TLT@drpgroup.com

Please read through the task below and send through any questions you may have before getting started. Spend around 30 minutes working through the task. (Excluding initial Laravel setup)
Our Expectation

Using the project provided we want you to integrate with a 3rd party API to pull in user data.

We want this to be maintainable and flexible to potentially add other API calls to the future. This code might also be used in other parts of the application to get a fresh set of the data from the API.

There's a few pointers we would suggest to think about when coming up with your solutions:

    How we would be able to test this using PHPUnit in the future if we needed to?
    Don't always write everything yourself you can pull in other packages if you feel they are needed.
    Don't want to worry about any sort of error handling of the API, so assume that the API will always exist and we always return you the expected data.

Task

Build a command that pulls data from an API and stores it against the User model.

    Call the [https://reqres.in/] API to pull in the first page of users only.

We could potentially use this command in a schedule to repeatedly update the users from the API.
