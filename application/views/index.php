<html>
<head>
<title>Lucene Search Engine</title>
</head>
<body>
    <form method="post" id="form" action="<?php echo site_url("search"); ?>">
        <input type="text" name="query" id="query" placeholder="Masukkan Kata Kunci Pencarian.." size="50" value="<?php echo set_value('query'); ?>" />
        <input type="submit" name="submit" value="Cari"/>
    </form>
        <?php 
      if (! empty($hits))
      { 
           if (count($hits) > 0) 
           {
                echo "Hasil Pencarian untuk kata kunci <strong>'".$query."'</strong>. <br />";
                    echo "Pengindeksan terhadap <strong>".$count ." dokumen </strong> dan menghasilkan <strong>".$hits_count." hits</strong>.<br />";   
            
            echo "<table border='0'>";
            foreach($hits as $hit)   
            {    
                echo "<tr><td>Judul</td><td width='5px'>:</td><td><a href='".$hit->link."' target='_blank' />".$hit->title."</a></td></tr>";            
                echo "<tr><td>Skor</td><td width='5px'>:</td><td>". sprintf('%.2f', $hit->score) .'</td></tr>';    
                echo "<tr><td>Sumber</td><td width='5px'>:</td><td>".$hit->link."</td></tr>";   
                echo "<tr><td colspan=2>&nbsp;</td></tr>";
            }
            echo "</table>";
        }
        else echo "Tidak ditemukan dokumen yang mengandung kata kunci <strong>'".$query."'</strong>.";
    }
 
?>