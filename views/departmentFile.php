<?php $title = 'Департамент';

include_once "shared/layout_header.php"; ?>

<div class="col col-8 m-auto">
<div class="text-center">
    <h4><?php echo $file->getFileName()?></h4>
</div>
<table class="table m-auto" width="60%">
    <thead>
    <tr>
        <th scope="col" class="header" >XML ID</th>
        <th scope="col" class="header" >PARENT XML ID</th>
        <th scope="col" class="header" >NAME DEPARTMENT</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($departments as $department)
    {?>
            <tr>
        <td><?php echo $department->getXmlId()?></td>
        <td><?php echo $department->getParentXmlId()?></td>
        <td><?php echo $department->getNameDepartment()?></td>
            </tr>
    <?php }?>

    </tbody>
</table>
    <a type="button" href="/b1task/controllers/csv.php?id=<?php echo $file->getFileId()?>" class="m-auto btn btn-outline-primary">to .csv</a>

</div>