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
<ol>
<?PHP
  foreach($dirlist as $file) {
    echo "<li>";
    echo "{$file['name']} is type ";
    echo "{$file['type']} and size of ";
    echo "{$file['size']}, last modified ";
    echo date('r', $file['lastmod']),"</li>\n";
  }
?>
</ol>
<p>hopefully that works</p>
