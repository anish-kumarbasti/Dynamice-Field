<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <style>
    body {
  font-family: 'Arial', sans-serif;
  margin: 0;
  padding: 0;
}

.container {
  display: flex;
}

.sidebar {
  height: 100vh;
  width: 250px;
  background-color: #111;
  padding-top: 20px;
}

.sidebar h2 {
  color: white;
  text-align: center;
}

.sidebar ul {
  list-style-type: none;
  padding: 0;
}

.sidebar li {
  padding: 8px;
  text-align: ;
}

.sidebar a {
  text-decoration: none;
  color: white;
  font-size: 18px;
  display: block;
  transition: 0.3s;
}

.sidebar a:hover {
  background-color: #575757;
}

.content {
  flex: 1;
  padding: 20px;
}

  </style>
</head>
<body>

<div class="container">
    @if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif
  <div class="sidebar">
    <h2>Dashboard</h2>
    <ul>
      <li><a href="{{url('manage/category')}}" >Manage Category</a></li>
      <li><a href="#about">Manage Sub-Category</a></li>
      <li><a href="#services">Manage Product</a></li>
      <li><a href="#contact">Add to Cart management</a></li>
    </ul>
  </div>

  <div class="content">
    <h2>Main Content</h2>
    <p>Your webpage content goes here.</p>
  </div>
</div>

</body>
</html>
