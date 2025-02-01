# Create root directory
$rootDir = "crm_test"
New-Item -ItemType Directory -Path $rootDir
Set-Location $rootDir

# Create main directories
$mainDirs = @(
    "app",
    "config",
    "database",
    "resources",
    "routes",
    "storage",
    "tests"
)

foreach ($dir in $mainDirs) {
    New-Item -ItemType Directory -Path $dir
}

# Create app structure
$appDirs = @(
    "app/Console",
    "app/Exceptions",
    "app/Http",
    "app/Http/Controllers",
    "app/Http/Controllers/Api",
    "app/Http/Middleware",
    "app/Http/Requests",
    "app/Models",
    "app/Services"
)

foreach ($dir in $appDirs) {
    New-Item -ItemType Directory -Path $dir
}

# Create controller files
$controllerFiles = @(
    "app/Http/Controllers/Api/ContactController.php",
    "app/Http/Controllers/Api/OrganizationController.php",
    "app/Http/Controllers/Controller.php"
)

foreach ($file in $controllerFiles) {
    New-Item -ItemType File -Path $file
}

# Create middleware and request files
New-Item -ItemType File -Path "app/Http/Middleware/LogApiRequests.php"
New-Item -ItemType File -Path "app/Http/Requests/ContactRequest.php"
New-Item -ItemType File -Path "app/Http/Requests/OrganizationRequest.php"

# Create model files
$modelFiles = @(
    "Company.php",
    "Contact.php",
    "ContactEmail.php",
    "ContactPhone.php",
    "Email.php",
    "Organization.php",
    "OrganizationContact.php",
    "Phone.php",
    "User.php"
)

foreach ($file in $modelFiles) {
    New-Item -ItemType File -Path "app/Models/$file"
}

# Create service files
New-Item -ItemType File -Path "app/Services/ContactService.php"
New-Item -ItemType File -Path "app/Services/OrganizationService.php"

# Create config files
$configFiles = @(
    "app.php",
    "auth.php",
    "database.php",
    "logging.php"
)

foreach ($file in $configFiles) {
    New-Item -ItemType File -Path "config/$file"
}

# Create database structure
$databaseDirs = @(
    "database/factories",
    "database/migrations",
    "database/seeders"
)

foreach ($dir in $databaseDirs) {
    New-Item -ItemType Directory -Path $dir
}

# Create factory files
$factoryFiles = @(
    "ContactFactory.php",
    "EmailFactory.php",
    "OrganizationFactory.php",
    "PhoneFactory.php",
    "UserFactory.php"
)

foreach ($file in $factoryFiles) {
    New-Item -ItemType File -Path "database/factories/$file"
}

# Create migration files
$migrationFiles = @(
    "2024_01_30_000001_create_company_table.php",
    "2024_01_30_000002_create_user_table.php",
    "2024_01_30_000003_create_contact_table.php",
    "2024_01_30_000004_create_organization_table.php",
    "2024_01_30_000005_create_email_table.php",
    "2024_01_30_000006_create_phone_table.php",
    "2024_01_30_000007_create_contact_email_table.php",
    "2024_01_30_000008_create_contact_phone_table.php",
    "2024_01_30_000009_create_organization_contact_table.php"
)

foreach ($file in $migrationFiles) {
    New-Item -ItemType File -Path "database/migrations/$file"
}

# Create seeder files
$seederFiles = @(
    "CompanySeeder.php",
    "ContactSeeder.php",
    "DatabaseSeeder.php",
    "EmailSeeder.php",
    "OrganizationSeeder.php",
    "PhoneSeeder.php",
    "UserSeeder.php"
)

foreach ($file in $seederFiles) {
    New-Item -ItemType File -Path "database/seeders/$file"
}

# Create resources and views directories
New-Item -ItemType Directory -Path "resources/views"

# Create route files
New-Item -ItemType File -Path "routes/api.php"
New-Item -ItemType File -Path "routes/web.php"

# Create storage structure
$storageDirs = @(
    "storage/app",
    "storage/app/public",
    "storage/framework",
    "storage/logs"
)

foreach ($dir in $storageDirs) {
    New-Item -ItemType Directory -Path $dir
}

# Create test structure
$testDirs = @(
    "tests/Feature",
    "tests/Unit"
)

foreach ($dir in $testDirs) {
    New-Item -ItemType Directory -Path $dir
}

# Create test files
$featureTests = @(
    "ContactApiTest.php",
    "OrganizationApiTest.php"
)

foreach ($file in $featureTests) {
    New-Item -ItemType File -Path "tests/Feature/$file"
}

$unitTests = @(
    "ContactTest.php",
    "OrganizationTest.php"
)

foreach ($file in $unitTests) {
    New-Item -ItemType File -Path "tests/Unit/$file"
}

# Create root files
$rootFiles = @(
    ".env",
    ".env.example",
    ".gitignore",
    "artisan",
    "composer.json",
    "package.json",
    "README.md"
)

foreach ($file in $rootFiles) {
    New-Item -ItemType File -Path $file
}

Write-Host "Laravel project structure created successfully!"