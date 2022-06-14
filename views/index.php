<?php include ROOT.'/views/layouts/header.php';?>
    <div class="container-fluid">
        <?php foreach ($conferenceList as $conferenceItem):?>
            <br>
            <div class="card">
                <div class="card-body">
                    <h5><a href="/conference/<?php echo $conferenceItem['id'];?>"><?php echo $conferenceItem['title'];?></a></h5>
                    <h6><p><?php echo $conferenceItem['date'];?></p></h6>
                    <a href="/conference/<?php echo $conferenceItem['id'];?>/delete"><button type="button" class="btn btn-outline-danger">Удалить</button></a>
                    <a href="/conference/<?php echo $conferenceItem['id'];?>/edit"><button type="button" class="btn btn-outline-warning">Изменить</button></a>
                    <a href="/conference/<?php echo $conferenceItem['id'];?>"><button type="button" class="btn btn-outline-info">Подробнее</button></a>
                </div>
            </div>
        <?php endforeach;?>
        <br>
    </div>
    <?php include ROOT.'/views/layouts/footer.php';?>