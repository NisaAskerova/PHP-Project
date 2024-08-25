<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        *{
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            text-decoration: none;
            list-style: none;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            outline: none;
        }

        nav {
            background-color: rgb(97, 64, 64);
            padding: 10px;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 70px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            align-items: center;
        }
        nav input{
            width: 300px;
            height: 30px;
            outline: none;
            padding: 0 10px;
            border-radius: 10px;
            border: 1px solid #333;
        }
        #searchBtn{
            width: 100px;
            height: 30px;
            border: 1px solid transparent;
            outline: none;
            cursor: pointer;
            border-radius: 10px;
            background-color: rgb(245, 179, 179);

        }
        nav ul {
            padding: 0;
            margin: 0;
            display: flex;
            align-items: center;
        }

        nav li,
        .top-nav-right>ul>ul>li {
            margin: 0;
        }

        nav a,
        .top-nav-right a {
            color: #ffffff;
            text-decoration: none;
            display: block;
            padding: 10px;
            font-weight: bold;
        }

        nav a:hover,
        .top-nav-right a:hover {
            background-color: rgb(143, 96, 96);

        }
        .formDiv {
            max-width: 500px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 100px auto;

        }

        .formDiv h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .formDiv label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .formDiv input[type="email"],
        .formDiv input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .formDiv button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            width: 100%;
            margin-top: 10px;
        }

        .formDiv button:hover {
            background-color: #555;
        }

        .error {
            color: #d9534f;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
            display: block;
        }

        .imgDiv {
            text-align: center;
            margin-bottom: 20px;
        }

        .imgDiv img {
            max-width: 100px;
            border-radius: 50%;
        }

        form {
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin: 100px auto;


        }

        form label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"],
        form input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        form input[type="radio"] {
            margin-right: 5px;
        }

        form button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            display: block;
            width: 100%;
            margin-top: 10px;
        }

        form button:hover {
            background-color: #555;
        }

        .error {
            color: #d9534f;
            font-size: 14px;
            margin-top: -10px;
            margin-bottom: 10px;
            display: block;
        }

        .top-nav-right {
            width: 250px;
            height: 100%;
            background-color: rgb(72, 47, 47);
            top: 0;
            left: 0;
            position: fixed;
            padding-right: 10px;
        }

        .top-nav-right>ul {
            margin-top: 20px;
            width: 100%;
        }

        .top-nav-right>ul>li {
            list-style: none;
            text-decoration: none;
            /* width: 100%; */
        }

        .main {
            width: 100%;
            margin-top: 70px;
            padding: 40px 100px;
        }

        .profileImg {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
        }
        .blogList {
            width: 100%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .title{
            width: 100%;
            overflow: hidden
        }
        .blogItem {
            width: 300px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .blogItem h3 {
            margin-top: 0;
            font-size: 24px;
            color: #333;
        }

        .blogItem p {
            margin: 10px 0;
            color: #555;
        }

        .blogItem img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 10px;
        }

        .blogItem hr {
            margin-top: 20px;
            border: none;
            border-top: 1px solid #ddd;
        }

        .blogItem button {
            padding: 10px 15px;
            margin-right: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
        }

        .blogItem button:hover {
            opacity: 0.9;
        }

        .blogItem button.delete {
            background-color: #e74c3c;
            color: white;
        }

        .blogItem button.update {
            background-color: #3498db;
            color: white;
        }
        .profileDiv{
            background-color: cadetblue;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-weight: 600;
        }
        .hero{
            margin-left:250px;
            padding: 20px;
        }
        .searchBtn{
            width: 90px;
            height: 30px;
            border: none;
            outline: none;
            background-color: #d9534f;
            border-radius: 10px;
        }
    </style>
</head>

<body>