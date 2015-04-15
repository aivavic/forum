<?php
/**
 * Class: index.php
 * User: Viktor Afanasjev
 * Date: 03.04.2015
 * Time: 8:21
 */
?>

    <table class="forum_list">
        <tr class="caption">
            <td>
                Название темы
            </td>
            <td>
                Просмотров(Ответов)
            </td>
            <td>
                Последнее сообщение
            </td>
        </tr>
        <?php foreach ($page->getPage() as $pages): ?>
            <tr>
                <td><a href="?topic=<?php echo $pages['id']; ?>"><?php echo $pages['name']; ?></a></td>
                <td><?php echo $pages['browsing'] . ' (' . $pages['reply'] . ') ' ?></td>
                <td><?php echo date('F j, Y, H:i:s', $pages['update_time']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php $page->getLinks(); ?>