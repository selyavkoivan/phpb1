<?php $title = 'Пользователь';

include_once "shared/layout_header.php"; ?>

<div class="col col-10 m-auto">
    <div class="text-center">
        <h4><?php echo $file->getFileName()?></h4>
    </div>
    <table class="table m-auto" width="60%">
        <thead>
        <tr>
            <th scope="col" class="header" >XML ID</th>
            <th scope="col" class="header" >LAST NAME</th>
            <th scope="col" class="header" >NAME</th>
            <th scope="col" class="header" >SECOND NAME</th>
            <th scope="col" class="header" >DEPARTMENT</th>
            <th scope="col" class="header" >WORK POSITION</th>
            <th scope="col" class="header" >EMAIL</th>
            <th scope="col" class="header" >MOBILE PHONE</th>
            <th scope="col" class="header" >PHONE</th>
            <th scope="col" class="header" >LOGIN</th>
            <th scope="col" class="header" >PASSWORD</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user)
        {?>
            <tr>
                <td><?php echo $user->getXmlId()?></td>
                <td><?php echo $user->getLastName()?></td>
                <td><?php echo $user->getName()?></td>
                <td><?php echo $user->getSecondName()?></td>
                <td><?php echo $user->getDepartment()?></td>
                <td><?php echo $user->getWorkPosition()?></td>
                <td><?php echo $user->getEmail()?></td>
                <td><?php echo $user->getMobilePhone()?></td>
                <td><?php echo $user->getPhone()?></td>
                <td><?php echo $user->getLogin()?></td>
                <td><?php echo $user->getPassword()?></td>
            </tr>
        <?php }?>

        </tbody>
    </table>
    <a type="button" href="/b1task/controllers/csv.php?id=<?php echo $file->getFileId()?>" class="m-auto btn btn-outline-primary">to .csv</a>
</div>