<?php

//udefined vars, of course

if (!mysql_connect($db_host, $db_user, $db_pwd))
    die("DB connection error");

if (!mysql_select_db($database))
    die("DB selection error");

// sending query
mysql_query("SET NAMES 'utf8'");
mysql_query("SET CHARACTER SET utf8 ");
$result = mysql_query("select phpbb_posts.poster_id as postid, phpbb_posts.post_time as post_time, phpbb_posts.post_text as post_text, phpbb_posts.post_id as pid, phpbb_posts.topic_id as tid, phpbb_posts.forum_id as fid, phpbb_topics.topic_title as topic_title, phpbb_users.username as username, phpbb_users.user_colour as usercolour, phpbb_posts.post_username as anon from phpbb_posts, phpbb_topics, phpbb_users where post_id IN (select * from (select max(post_id) as mpt from phpbb_posts group by topic_id order by mpt desc limit 12) alias ) AND post_approved=1 AND phpbb_posts.forum_id != 23 AND phpbb_posts.forum_id != 24 AND phpbb_posts.forum_id != 25 AND phpbb_posts.forum_id != 26 AND phpbb_posts.forum_id != 27 AND phpbb_posts.forum_id != 31 AND phpbb_posts.forum_id != 28 AND phpbb_posts.forum_id != 29 AND phpbb_posts.topic_id=phpbb_topics.topic_id and phpbb_posts.poster_id=phpbb_users.user_id order by post_time desc;");

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

if (!$result) {
    die("DB query error");
}

echo "<aside class='topic-ultimos'><table style='background-color:#ffffff'>";
$i = 0;
while($row = mysql_fetch_assoc($result))
{
    $i = $i+1; // This is to have different color for odd/even rows
    echo "<tr><td class='dtq' style='padding-top: 5px;padding-right: 5px;padding-left: 5px;padding-bottom:5px;'>";
    $ptime = strftime('%A, %d %b. %Y às %H:%M', $row['post_time']);
    $puser = ($row['username']=="Anonymous")?$row['anon']:$row['username'];
    $datosa = strftime('%d-%m-%Y', $row['post_time']); //pega a data do tópico de um jeito mais simples
    $datona = date("d-m-Y"); //pega a data do dia
    $datontem = date("d-m-Y", strtotime( '-1 days' ) ); //pega a data de ontem - dava pra fazer isso com a var anterior? dava, mas eu nao quis
    if($datosa==$datona){
      $ptime = strftime('Hoje às %H:%M', $row['post_time']);
    }
    else if($datosa==$datontem){
      $ptime = strftime('Ontem às %H:%M', $row['post_time']);
    }
    $cor = $row['usercolour'];
    $puid = $row['postid'];
    $negris = '700';
    if($cor==null){
      $negris = '300';
    }
    echo ''
    ."</b>»&nbsp; <a style ='font-weight: 300;' href='./viewtopic.php?"."f=".$row['fid']."&t=".$row['tid']."&p=".$row['pid']."#p".$row['pid']."'><b>".$row['topic_title']."</b></a><br><i class='fa fa-clock-o' aria-hidden='true'></i> ".$ptime." por <a href='./memberlist.php?mode=viewprofile&u=".$puid."'><span style='text-decoration: inherit;font-weight:".$negris.";color:#".$cor."'>".$puser."</span></a>";
    echo "</td></tr></aside>";
}
mysql_free_result($result);
?>
</table>
<h4></h4>
