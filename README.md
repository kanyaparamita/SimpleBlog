# Simple Blog

## Description

A simple blog created using the PHP programming language.

## Specifications

### List Post

List Post is the start page of the blog that contains a list of posts that have been made. Each item in the post list contains `Judul`, `Tanggal`, and `Konten` (title, date, and content). There is also a menu for editing and deleting the post item.

### Add Post

Add Post is a page to add a new post. The new post has forms to fill in `Judul`, `Tanggal`, and  `Konten` (title, date, and content). Perform **validation** for the date with javascript so that the date entered is greater than or equal to the date when adding the new post.

### Edit Post

Edit posts that have already been made. The form that is displayed is the same as when adding a new form.

### Delete Post

Delete posts that have already been made. Do **confirmation** with javascript to confirm the user's deletion of the post. Issue a confirmation containing the following message

     Are you sure you want to delete this post?

If the user selects `yes` then the post is deleted, otherwise the post is not deleted.

### View Posts

The View Post page is a page for viewing a post. On this page there is information on `Judul`, `Tanggal`, and  `Konten` (title, date, and content), as well as **Comments** (specifications below).

### Comment

Comments contains a list of comments written for a particular post. The comment form consists of `Nama`, `Email`, and `Komentar` (name, email, and comment), also save the date the comment was made. Each item in the comments list contains `Nama`, `Tanggal`, and `Komentar` (name, date, and comment).