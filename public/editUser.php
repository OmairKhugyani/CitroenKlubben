<?php
include("header.php");
require_once("../classes/Member.php");
require_once("../config.php");

$member = new Member($db);

// Hent alle medlemmer
$members = $member->getAllMembers();

include("header.php");
?>
<div class="container container-lg box-bg-gradient">
    <a class="btn-small" href="mainMenu.php"><svg class="svg-door"></svg>Tilbage</a>
    <h1>Rediger medlem</h1>

    <main class="box-content-padding box-center flex">
        <?php if (!empty($members)): ?>
            <div class="container_space-around">
                <?php foreach ($members as $m): ?>
                    <div class="box-input-container box-member-item">
                        <p><strong>ID:</strong> <?= htmlspecialchars($m['MemberID']); ?></p>
                        <p><strong>Navn:</strong> <?= htmlspecialchars($m['FirstName'] . ' ' . $m['LastName']); ?></p>
                        <a href="editMemberForm.php?id=<?= $m['MemberID']; ?>" class="btn btn-white-greenhover">
                            <svg class="svg-user-edit"></svg> Rediger
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>Ingen medlemmer fundet.</p>
        <?php endif; ?>
    </main>
</div>
<?php
include("footer.php");
?>
