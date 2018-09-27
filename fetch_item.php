<?php
if(isset($_POST["query"]))
{
 $connect = mysqli_connect('localhost', 'root', 'Blake200.', 'mini');
 $request = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM items
  WHERE NAME LIKE '%".$request."%' 
  OR DESCRIPTION LIKE '%".$request."%' 
  OR ITEMTYPE LIKE '%".$request."%'
 ";
 $result = mysqli_query($connect, $query);
 $data =array();
 $html = '';
 $html .= '
  <table class="table table-bordered table-striped">
   <tr>
    <th>Name</th>
    <th>DESCRIPTION</th>
    <th>ITEM TYPE</th>
   </tr>
  ';
 if(mysqli_num_rows($result) > 0)
 {
  while($row = mysqli_fetch_array($result))
  {
   $data[] = $row["NAME"];
   $data[] = $row["DESCRIPTION"];
   $data[] = $row["ITEMTYPE"];
   $html .= '
   <tr>
    <td>'.$row["NAME"].'</td>
    <td>'.$row["DESCRIPTION"].'</td>
    <td>'.$row["ITEMTYPE"].'</td>
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
