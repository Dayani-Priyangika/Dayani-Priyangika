<?php
/**
 * index.php - Single-file dynamic dashboard (HTML + CSS + JS + PHP)
 *
 * Features:
 * - Tries to connect to MySQL if $use_mysql = true (configure below)
 * - Otherwise uses SQLite (auto file: data.db) and seeds sample data if empty
 * - Provides AJAX endpoints via ?action=get_courses and ?action=mark_accessed
 * - Renders a dashboard UI and fetches data dynamically (no page reload)
 *
 * Usage:
 * - Save to your web server (e.g., XAMPP htdocs)
 * - Open in browser
 */

// ---------- Configuration ----------
$use_mysql = false; // set true if you want MySQL (edit credentials below)
$mysql_host = '127.0.0.1';
$mysql_db   = 'bolana';
$mysql_user = 'root';
$mysql_pass = ''; // put your MySQL root password
// -----------------------------------

// Make DB connection (MySQL or SQLite fallback)
try {
    if ($use_mysql) {
        $dsn = "mysql:host={$mysql_host};dbname={$mysql_db};charset=utf8mb4";
        $pdo = new PDO($dsn, $mysql_user, $mysql_pass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } else {
        $dbfile = __DIR__ . '/data.db';
        $dsn = "sqlite:$dbfile";
        $pdo = new PDO($dsn, null, null, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo "Database connection failed: " . htmlspecialchars($e->getMessage());
    exit;
}

// Initialize tables + seed sample data if necessary
function ensure_schema_and_seed($pdo, $use_mysql) {
    // Create courses table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS courses (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            subtitle TEXT,
            grade TEXT,
            color TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP
        );
    ");

    // Create recent_access table
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS recent_access (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            course_id INTEGER NOT NULL,
            accessed_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            FOREIGN KEY(course_id) REFERENCES courses(id)
        );
    ");

    // Check if courses has rows, if not insert demo rows
    $stmt = $pdo->query("SELECT COUNT(*) FROM courses");
    $count = (int)$stmt->fetchColumn();
    if ($count === 0) {
        $samples = [
            ['Grade 10 - Mathematics','Algebra and Geometry','Grade 10','#BEE6FF'],
            ['Grade 11 - Science','Physics and Chemistry','Grade 11','#CFC8F2'],
            ['Grade 10 - English','Grammar & Writing','Grade 10','#BFE7DD'],
            ['Grade 9 - ICT','Basics of Computing','Grade 9','#E6F6FF'],
            ['Grade 8 - Sinhala','Language Skills','Grade 8','#FFDFA0'],
            ['Grade 12 - History','World History Overview','Grade 12','#D8C5EE'],
            ['Grade 10 - Commerce','Accounting, Business Studies','Grade 10','#EFD1D1'],
            ['Grade 11 - Agriculture','Planting, Farming Techniques','Grade 11','#C8B0E0'],
            ['Grade 9 - ICT','Basics of Computing','Grade 9','#E6F6FF'],
            ['Grade 8 - Sinhala','Language Skills','Grade 8','#FFDFA0'],
        ];
        $ins = $pdo->prepare("INSERT INTO courses (title, subtitle, grade, color) VALUES (?, ?, ?, ?)");
        foreach ($samples as $s) $ins->execute($s);
    }
}

ensure_schema_and_seed($pdo, $use_mysql);

// ---------- AJAX endpoints ----------
$action = $_GET['action'] ?? null;
if ($action === 'get_courses') {
    header('Content-Type: application/json; charset=utf-8');

    // Fetch courses
    $stmt = $pdo->query("SELECT id, title, subtitle, grade, color FROM courses ORDER BY id ASC");
    $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch recent accessed (last 3)
    $recentStmt = $pdo->query("SELECT r.course_id, r.accessed_at, c.title, c.subtitle, c.color
                               FROM recent_access r
                               JOIN courses c ON c.id = r.course_id
                               ORDER BY r.accessed_at DESC
                               LIMIT 3");
    $recent = $recentStmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['courses'=>$courses, 'recent'=>$recent]);
    exit;
}

if ($action === 'mark_accessed' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $course_id = (int)($input['course_id'] ?? 0);
    if ($course_id <= 0) {
        http_response_code(400);
        echo json_encode(['error'=>'Invalid course id']);
        exit;
    }
    $stmt = $pdo->prepare("INSERT INTO recent_access (course_id, accessed_at) VALUES (?, datetime('now'))");
    // SQLite uses datetime('now'), MySQL will accept NOW() if using MySQL - keep cross-compat by using PHP
    if ($pdo->getAttribute(PDO::ATTR_DRIVER_NAME) === 'mysql') {
        $stmt = $pdo->prepare("INSERT INTO recent_access (course_id, accessed_at) VALUES (?, NOW())");
        $stmt->execute([$course_id]);
    } else {
        $stmt->execute([$course_id]);
    }
    echo json_encode(['ok'=>true]);
    exit;
}

// If no action, render the page below (HTML + CSS + JS)
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>Bolana Dashboard</title>
<link rel="icon" href="data:;base64,iVBORw0KGgo=">
<style>
    /* ---------- Basic reset ---------- */
    :root{
        --sidebar:#243864;
        --topbar:#1d73c7;
        --page-bg:#eef4f8;
        --card-bg:#fff;
        --muted:#6b7a8c;
        --radius:12px;
    }
    *{box-sizing:border-box}
    body{
        font-family: "Segoe UI", Roboto, Arial, sans-serif;
        background:var(--page-bg);
        color:#1f2d3d;
    }

    /* ---------- layout ---------- */
    .app{
        display:flex;
        min-height:100vh;
    }
    aside.sidebar{
        width:250px;
        background:var(--sidebar);
        color:#fff;
        padding:30px 20px;
        display:flex;
        flex-direction:column;
        gap:24px;
    }
    .logo{
        display:flex;
        align-items:center;
        gap:14px;
    }
    .logo .brand{
        font-weight:700;
        font-size:20px;
        line-height:1;
    }
    nav.menu{margin-top:10px}
    nav.menu a{
        display:block;
        color:#dfe9ff;
        text-decoration:none;
        padding:10px 6px;
        border-radius:6px;
        margin-bottom:8px;
        font-weight:500;
    }
    nav.menu a:hover{background:rgba(255,255,255,0.04)}

    main.content{
        flex:1;
        padding:18px 28px;
    }
    header.topbar{
        height:60px;
        background:var(--topbar);
        color:#fff;
        display:flex;
        align-items:center;
        justify-content:space-between;
        padding:0 22px;
        border-radius:0 0 6px 6px;
        box-shadow:0 1px 0 rgba(0,0,0,0.06);
    }
    .page{
        margin-top:18px;
        padding:22px;
        background:linear-gradient(180deg, rgba(255,255,255,0.9), rgba(255,255,255,0.8));
        border-radius:10px;
        min-height:calc(100vh - 120px);
    }

    h1.page-title{margin:0; font-size:26px; font-weight:700; color:#fff; padding-left:6px;}

    .section{
        margin:20px 0;
    }
    .section h2{
        font-size:20px;
        margin:8px 0 14px;
        color:#254154;
    }

    /* ---------- recent cards ---------- */
    .recent-row{display:flex; gap:18px; flex-wrap:wrap;}
    .recent-card{
        min-width:260px;
        flex:1 1 260px;
        padding:18px;
        border-radius:12px;
        box-shadow:0 6px 12px rgba(10,20,40,0.06);
        cursor:pointer;
        transition:transform .15s, box-shadow .15s;
    }
    .recent-card:hover{transform:translateY(-6px)}
    .card-title{font-weight:700; margin-bottom:8px; color:#15324a}
    .card-sub{color:var(--muted); font-size:14px}

    /* ---------- grid of courses ---------- */
    .grid{
        display:grid;
        grid-template-columns:repeat(4, 1fr);
        gap:18px;
    }
    @media (max-width:1100px){ .grid{grid-template-columns:repeat(3,1fr)} }
    @media (max-width:800px){ .grid{grid-template-columns:repeat(2,1fr)} }
    @media (max-width:520px){ .grid{grid-template-columns:repeat(1,1fr)} }

    .course-card{
        padding:18px;
        border-radius:12px;
        box-shadow:0 6px 10px rgba(10,20,40,0.05);
        cursor:pointer;
        transition:transform .12s, box-shadow .12s;
        min-height:84px;
    }
    .course-card:hover{transform:translateY(-6px)}
    .course-card .title{font-weight:700}
    .course-card .desc{color:var(--muted); font-size:13px; margin-top:6px}

    /* small decoration */
    .left-panel-heading{
        margin-top:20px;
        font-weight:800;
        font-size:24px;
        line-height:1.1;
        color:#fff;
    }
    .sidebar .small{
        font-size:14px; color:rgba(255,255,255,0.85)
    }

    /* footer note */
    .note{margin-top:18px; color:#7e8992; font-size:13px}
</style>
</head>
<body>
<div class="app">
    <aside class="sidebar">
        <div class="logo">
            <svg width="48" height="48" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg"><rect rx="10" width="64" height="64" fill="#2D4A84"/></svg>
            <div>
                <div class="brand">Bolana</div>
                <div class="small">Education Center</div>
            </div>
        </div>

        <div class="left-panel-heading">Bolana<br/>Education Center</div>

        <nav class="menu">
            <a href="#">Dashboard</a>
            <a href="#">Students</a>
            <a href="#">Teachers</a>
            <a href="#">Courses</a>
            <a href="#">Notices</a>
            <a href="#">Contact</a>
        </nav>

        <div class="note">Logged as <strong>Admin</strong></div>
    </aside>

    <main class="content">
        <header class="topbar">
            <div style="display:flex;align-items:center;gap:14px">
                <h1 class="page-title">Dashboard</h1>
            </div>
            <div>Admin</div>
        </header>

        <div class="page">
            <section class="section">
                <h2>Recently Accessed Courses</h2>
                <div id="recent" class="recent-row">
                    <!-- recent cards inserted by JS -->
                </div>
            </section>

            <section class="section">
                <h2>Course Overview</h2>
                <div id="coursesGrid" class="grid">
                    <!-- course cards inserted by JS -->
                </div>
            </section>
        </div>
    </main>
</div>

<script>
const API = location.pathname + '?action=';
async function fetchData(){
    const res = await fetch(API + 'get_courses');
    if(!res.ok) { console.error('Failed fetch'); return; }
    const data = await res.json();
    renderRecent(data.recent || []);
    renderCourses(data.courses || []);
}

function renderRecent(items){
    const root = document.getElementById('recent');
    root.innerHTML = '';
    if(items.length === 0){
        root.innerHTML = '<div style="color:#6b7a8c">No recent courses yet. Click a course card to mark as accessed.</div>';
        return;
    }
    for(const it of items){
        const div = document.createElement('div');
        div.className = 'recent-card';
        div.style.background = it.color || '#eaeff6';
        div.dataset.courseId = it.course_id;
        div.innerHTML = `<div class="card-title">${escapeHtml(it.title)}</div>
                         <div class="card-sub">${escapeHtml(it.subtitle || '')}</div>`;
        div.onclick = () => openCourse(it.course_id);
        root.appendChild(div);
    }
}

function renderCourses(courses){
    const root = document.getElementById('coursesGrid');
    root.innerHTML = '';
    for(const c of courses){
        const div = document.createElement('div');
        div.className = 'course-card';
        div.style.background = c.color || '#fff';
        div.dataset.id = c.id;
        div.innerHTML = `<div class="title">${escapeHtml(c.title)}</div>
                         <div class="desc">${escapeHtml(c.subtitle || '')}</div>`;
        div.onclick = () => openCourse(c.id);
        root.appendChild(div);
    }
}

function escapeHtml(s){
    return (s+'').replace(/[&<>"']/g, (m)=>({ '&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;' })[m]);
}

async function openCourse(courseId){
    // simulate opening a course: mark accessed, then refresh recent list
    await fetch(API + 'mark_accessed', {
        method:'POST',
        headers: {'Content-Type':'application/json'},
        body: JSON.stringify({course_id: courseId})
    });
    await fetchData();
    // Optionally navigate to course page (not implemented)
    alert('Opened course id: ' + courseId);
}

// load on start
fetchData();
</script>
</body>
</html>
