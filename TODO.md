# TODO: Change 'staff' role to 'supplier' in the application

## Database Changes
- [x] Create new migration to update role enum from 'staff' to 'supplier' in users table
- [x] Update existing users with role 'staff' to 'supplier' in the database

## Model Updates
- [x] Update User model: change isStaff() to isSupplier(), update role check from 'staff' to 'supplier'

## Controller Updates
- [x] Update AuthController: change 'staff' references to 'supplier'
-  - [x] Update UserController: change 'staff' references to 'supplier'
- [x] Update SupplierController: change 'staff' references to 'supplier'
- [x] Update ItemController: change isStaff() calls to isSupplier()
- [x] Update DashboardController: change staff() method to supplier()
- [x] Update UserController reject method: change 'staff' to 'supplier'

## Middleware Updates
- [x] Update RoleMiddleware: change 'staff' references to 'supplier'
- [x] Update VerifyCsrfToken: change 'staff' references to 'supplier'

## Route Updates
- [x] Update web.php: change 'staff' routes to 'supplier' routes

## View Updates
- [x] Rename resources/views/staff/ directory to resources/views/supplier/
- [x] Update view files: change 'staff' references to 'supplier' in content
- [x] Update sidebar and layout files: change 'staff' references to 'supplier'

## Seeder and Factory Updates
- [x] Update UserSeeder: change 'staff' role to 'supplier'
- [x] Update UserFactory: change 'staff' role to 'supplier'

## Test Updates
- [x] Update test files: change 'staff' references to 'supplier' (test_staff_login.php, test_staff_route.php, etc.)
- [x] Update test assertions and data
- [x] Rename test files to remove 'staff' from filenames

## Additional Files
- [x] Update any other files with 'staff' references (check_users.php, etc.)
- [x] Clean up outdated VSCode tabs showing staff paths (these are cached and don't reflect actual file structure)

## Issue Resolution
- [x] Fixed BadMethodCallException: DashboardController::supplier method not found
- [x] Cleared all Laravel caches (route, config, view, application cache)
- [x] Verified route registration and method existence
- [x] Confirmed syntax validation passes
- [x] Fix DashboardController method name from staff() to supplier() and update view reference
- [x] Update test files: change 'staff' references to 'supplier' (test_staff_login.php, test_staff_route.php, etc.)
- [x] Rename test files to remove 'staff' from filenames
