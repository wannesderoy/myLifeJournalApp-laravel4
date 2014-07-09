My Life Journal
===============
Build in laravel 4. This is my first app where I have gone deep into laravel, but i like it ;)

What
====
This app presents the user with a unique question every day of the year. The questions vary from very deep life challenging questions, to more lightweight questions. When one year has passed th user is presented with the same question every day, but now he can see and ponder how his vision on that question has changed over the course of the year. When done for a few years they can see themselves evolve and grow.

Why
===
Just because I want to, and because of a school assignment.
I wanted to learn the basics of Laravel and a few steps further, what it can do, and how I can do what I want to do.

How
===
I started by designing my database and using artisan migration to create it. I made a model with the right relationships for every table which accessed all the data I needed to have in my views. All the logic for the daily questions and their related answers from a specific user is put into functions who I can call everywhere I want.

In the controllers I write all my logic for the forms in the app. They contain checks, making of my views and writing to the database via my model Classes and functions.

The app is build to be as lightweight and safe as possible for my knowledge, no useless code, pointless database queries or form without a token.


This whole app is part assignment, part learning, part enjoyment.