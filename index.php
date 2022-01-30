<!DOCTYPE html>
<html>
<head>
	<title>Tobin Cooney</title>
	<link rel="icon" type="image/png" href="/icon.png" />
	<link rel="stylesheet" href="/style.css" />
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400&display=swap" rel="stylesheet" />
	<link href="https://fonts.googleapis.com/css2?family=Bitter&display=swap" rel="stylesheet">

	<style>
		table {
			border-collapse: collapse;
			width: 100%;
			font-family: 'Courier New', monospace;
		}
		th {
			font-size: 110%;
			background-color: white;
			color: #f85552;
			font-family: "Bitter", serif;
			padding: 8px;
			text-align: left;
		}
		td {
			padding: 3px;
			border: solid 1px #ededed;
		}
		tr:nth-child(odd) {
			background-color: #ededed;
		}
		a {
			font-weight: normal;
		}
	</style>

	<?PHP
		function getFileList($dir)
		{
			$retval = [];
			if(substr($dir, -1) != "/") {
				$dir .= "/";
			}
			$d = @dir($dir) or die("getFileList: Failed opening directory {$dir} for reading");
			while(FALSE !== ($entry = $d->read())) {
				if($entry{0} == ".") continue;
				if(is_dir("{$dir}{$entry}")) {
					$retval[] = [
						'name' => "{$dir}{$entry}/",
						'type' => filetype("{$dir}{$entry}"),
						'size' => 0,
						'lastmod' => filemtime("{$dir}{$entry}")
					];
				} elseif(is_readable("{$dir}{$entry}")) {
					$retval[] = [
						'name' => "{$dir}{$entry}",
						'type' => mime_content_type("{$dir}{$entry}"),
						'size' => filesize("{$dir}{$entry}"),
						'lastmod' => filemtime("{$dir}{$entry}")
					];
				}
			}
			$d->close();

			return $retval;
		}
		$dirlist = getFileList(".");
	?>

</head>
<body>
	<br>
	<h3 style="text-decoration: none;">an attempt at a php index</h3>
	<p>i'm not great at php, so sorry if this page displays a little weird</p>
	<br>
	<table>
		<tr>
			<th width="58%">file</th>
			<th width="14%">type</th>
			<th width="14%">size</th>
			<th width="14%">last modified</th>
		</tr>
		<?PHP
			foreach($dirlist as $file) {
				echo "<tr>";
				echo "<td><a href='", "{$file['name']}", "'>{$file['name']}</a></td>";
				echo "<td>{$file['type']}</td>";
				echo "<td>{$file['size']}</td>";
				echo "<td>";
				echo date('d M Y', $file['lastmod']),"</td>";
				echo "</tr>";
			}
		?>
		<tr>
			<td><a href="../">..</a></td>
		</tr>
	</table>
</body>
</html>
