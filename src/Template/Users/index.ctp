<h1>users</h1>
<table>
    <tr>
        <th>Id</th>
        <th>Username</th>
    </tr>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user->id ?></td>
        <td><?= $this->Html->link($user->username, ['action' => 'view', $user->id]) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
