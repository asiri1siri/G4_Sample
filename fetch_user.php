<?php
if(isset($_POST["query"]))
{
 $connect = mysqli_connect('localhost', 'root', 'Blake200.', 'testdb');
 $request = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM Users 
  WHERE FirstName LIKE '%".$request."%' 
  OR UserName LIKE '%".$request."%' 
  OR Email LIKE '%".$request."%'
 ";
 $result = mysqli_query($connect, $query);
 $data =array();
 $html = '';
 $html .= '
  <table class="table table-bordered table-striped">
   <tr>
    <th>Name</th>
    <th>UserName</th>
    <th>Email</th>
   </tr>
  ';
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $data[] = $row["FirstName"];
   $data[] = $row["UserName"];
   $data[] = $row["Email"];
   $html .= '
   <tr>
    <td>'.$row["FirstName"].'</td>
    <td>'.$row["UserName"].'</td>
    <td>'.$row["Email"].'</td>
   </tr>
   ';
  }
 }
 else
 {
  $data = 'No Data Found';
  $html .= '
   <tr>
    <td colspan="3">No Data Found</td>
   </tr>
   ';
 }
 $html .= '</table>';
 if(isset($_POST['typehead_search']))
 {
  echo $html;
 }
 else
 {
  $data = array_unique($data);
  echo json_encode($data);
 }
}

?>
