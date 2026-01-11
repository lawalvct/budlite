# Delete All Tenants Scripts

This document explains how to use the scripts created to delete all tenants and their related records from the database.

## ⚠️ IMPORTANT WARNINGS

-   **DESTRUCTIVE OPERATION**: These scripts will permanently delete ALL tenants and ALL related data
-   **NO UNDO**: Once executed, the data cannot be recovered unless you have a backup
-   **PRODUCTION USE**: NEVER run these scripts on a production database unless you are absolutely certain
-   **BACKUP FIRST**: Always create a database backup before running these scripts

## Available Options

### Option 1: Standalone PHP Script

**File**: `delete_all_tenants.php`

A standalone PHP script that can be run directly from the command line without using Laravel's Artisan.

#### Usage:

```bash
php delete_all_tenants.php
```

#### Features:

-   Color-coded console output
-   Interactive confirmation prompts
-   Detailed progress reporting
-   Comprehensive deletion summary
-   Handles foreign key constraints automatically
-   Detailed error reporting

#### Output:

-   ✓ Green checkmarks for successful deletions
-   ✗ Red X for errors
-   ⚠ Yellow warnings for missing tables
-   ℹ Blue info messages for status updates

---

### Option 2: Laravel Artisan Command (Recommended)

**File**: `app/Console/Commands/DeleteAllTenants.php`

A Laravel Artisan command that integrates with Laravel's console system.

#### Basic Usage:

```bash
php artisan tenants:delete-all
```

#### With Options:

```bash
# Force deletion without confirmation prompts
php artisan tenants:delete-all --force

# Dry run - see what would be deleted without actually deleting
php artisan tenants:delete-all --dry-run

# Combine options
php artisan tenants:delete-all --dry-run --force
```

#### Features:

-   Interactive confirmation prompts (double confirmation)
-   Dry-run mode to preview deletions
-   Force mode to skip confirmations
-   Progress bar for better UX
-   Categorized deletion summary
-   Displays tenant list before deletion
-   Professional formatted output

#### Available Flags:

| Flag        | Description                                                   |
| ----------- | ------------------------------------------------------------- |
| `--force`   | Skip all confirmation prompts                                 |
| `--dry-run` | Show what would be deleted without actually deleting anything |

---

## What Gets Deleted

Both scripts delete records from the following categories:

### 1. Sales & Orders

-   Sales, Sale Items, Sale Payments
-   Orders, Order Items
-   Quotations, Quotation Items
-   Invoices, Invoice Items
-   Receipts, Carts, Cart Items
-   Wishlists, Wishlist Items

### 2. Inventory & Products

-   Products, Product Images, Product Categories
-   Stock Movements, Stock Journal Entries
-   Physical Stock Vouchers and Entries
-   Purchase Orders and Items
-   Units

### 3. Accounting & Finance

-   Vouchers, Voucher Entries, Voucher Types
-   Ledger Accounts, Account Groups
-   Journal Entries and Details
-   Banks, Bank Reconciliations
-   Payment Methods, Tax Brackets, Tax Rates

### 4. HR & Payroll

-   Employees, Departments, Positions
-   Attendance Records, Overtime Records
-   Employee Leaves, Leave Balances
-   Shift Schedules, Shift Assignments
-   Payroll Periods, Payroll Runs
-   Employee Salaries, Salary Components
-   Employee Loans, Documents
-   Employee Announcements
-   Leave Types, Public Holidays
-   PFAs (Pension Fund Administrators)

### 5. Customers & Vendors

-   Customers, Customer Authentications
-   Customer Activities
-   Vendors

### 6. Users & Permissions

-   Users, Roles, Permissions, Teams
-   All pivot tables (role_user, permission_role, team_user, etc.)

### 7. Subscriptions & Affiliates

-   Subscriptions, Subscription Payments
-   Affiliate Commissions, Referrals, Payouts

### 8. Support System

-   Support Tickets, Replies, Attachments
-   Ticket Status Histories

### 9. Configuration & Settings

-   E-commerce Settings
-   Shipping Methods, Coupons
-   Invoice Templates
-   Cash Registers and Sessions
-   Settings, Knowledge Base Articles
-   Domains, Tenant Invitations
-   Backups

### 10. Finally: Tenants

-   The tenants table itself

---

## Execution Flow

Both scripts follow this process:

1. **Check**: Count existing tenants
2. **Display**: Show tenant information
3. **Confirm**: Ask for user confirmation (unless `--force` is used)
4. **Disable**: Temporarily disable foreign key checks
5. **Delete**: Process all related tables in order
6. **Delete**: Remove all tenants
7. **Enable**: Re-enable foreign key checks
8. **Report**: Display comprehensive summary

---

## Examples

### Example 1: Check What Would Be Deleted (Recommended First Step)

```bash
php artisan tenants:delete-all --dry-run
```

This will show you:

-   How many tenants exist
-   List of all tenants
-   How many records in each table would be deleted
-   Categorized summary
-   **No actual deletion occurs**

### Example 2: Delete All Tenants with Confirmation

```bash
php artisan tenants:delete-all
```

This will:

-   Show tenant list
-   Ask for confirmation twice
-   Proceed with deletion
-   Show detailed progress
-   Display final summary

### Example 3: Force Delete (Use with Caution)

```bash
php artisan tenants:delete-all --force
```

This will:

-   Skip all confirmations
-   Immediately start deletion
-   Useful for automated scripts/testing environments

### Example 4: Using the Standalone Script

```bash
php delete_all_tenants.php
```

This will:

-   Display tenant count
-   Ask for confirmation (type "yes" to proceed)
-   Show colored progress output
-   Display detailed summary

---

## Output Examples

### Artisan Command Output:

```
╔═══════════════════════════════════════════════════════════════════════════╗
║                      DELETE ALL TENANTS COMMAND                           ║
╚═══════════════════════════════════════════════════════════════════════════╝

Found 3 tenant(s) in the database.

┌────┬───────────────┬──────────┬──────────────────┬────────┬─────────────────┐
│ ID │ Name          │ Slug     │ Email            │ Status │ Created         │
├────┼───────────────┼──────────┼──────────────────┼────────┼─────────────────┤
│ 1  │ Acme Corp     │ acme     │ info@acme.com    │ active │ 2026-01-01 10:00│
│ 2  │ TechStart Inc │ techstart│ hello@tech.com   │ trial  │ 2026-01-05 14:30│
│ 3  │ Global Ltd    │ global   │ contact@global.co│ active │ 2026-01-08 09:15│
└────┴───────────────┴──────────┴──────────────────┴────────┴─────────────────┘

⚠️  WARNING: This will delete ALL tenants and their related data!
⚠️  This operation CANNOT be undone!

 Are you absolutely sure you want to continue? (yes/no) [no]:
 > yes

 Please confirm again. Delete ALL tenants? (yes/no) [no]:
 > yes

─────────────────────────────────────────────────────────────────────────────
Starting deletion process...
─────────────────────────────────────────────────────────────────────────────

Processing 82 related tables...

 82/82 [▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓▓] 100%

─────────────────────────────────────────────────────────────────────────────
Processing tenants table...
✓ Deleted 3 tenant(s)

═════════════════════════════════════════════════════════════════════════════
DELETION SUMMARY
═════════════════════════════════════════════════════════════════════════════
Total records deleted: 1,247
Tenants deleted: 3

Detailed breakdown:

Sales & Orders:
  • Sales: 150
  • Sale Items: 485
  • Orders: 45
  • Order Items: 120

HR & Payroll:
  • Employees: 25
  • Attendance Records: 340
  • Payroll Runs: 12

...

═════════════════════════════════════════════════════════════════════════════
✓ All tenants and related records have been successfully deleted!
═════════════════════════════════════════════════════════════════════════════
```

---

## Database Backup Before Deletion

### Option 1: Using mysqldump

```bash
# Full database backup
mysqldump -u username -p database_name > backup_$(date +%Y%m%d_%H%M%S).sql

# Backup with compression
mysqldump -u username -p database_name | gzip > backup_$(date +%Y%m%d_%H%M%S).sql.gz
```

### Option 2: Using Laravel

```bash
# If you have backup package installed
php artisan backup:run
```

### Option 3: Manual Export

Use a database management tool like:

-   phpMyAdmin
-   MySQL Workbench
-   TablePlus
-   DBeaver

---

## Troubleshooting

### Issue: Foreign Key Constraint Errors

**Solution**: The scripts automatically disable foreign key checks. If you still get errors:

```sql
-- Manually disable and re-enable
SET FOREIGN_KEY_CHECKS=0;
-- Run deletion
SET FOREIGN_KEY_CHECKS=1;
```

### Issue: Permission Denied

**Solution**: Make sure the database user has DELETE permissions:

```sql
GRANT DELETE ON database_name.* TO 'user'@'localhost';
FLUSH PRIVILEGES;
```

### Issue: Script Timeout

**Solution**: Increase PHP execution time:

```php
// Add to top of script
set_time_limit(0); // Unlimited
ini_set('memory_limit', '512M');
```

### Issue: Table Not Found Warnings

**Solution**: This is normal. The scripts check for table existence and skip missing tables automatically.

---

## Safety Recommendations

1. **ALWAYS backup your database first**
2. **Run with `--dry-run` first** to see what will be deleted
3. **Test on a development/staging environment** before production
4. **Verify tenant list** before confirming deletion
5. **Check deletion summary** after completion
6. **Keep backups** for at least 30 days after deletion

---

## When to Use These Scripts

### ✅ Appropriate Use Cases:

-   Development/testing environment cleanup
-   Staging environment reset
-   Removing test data before production deployment
-   Complete system reset for fresh start
-   Database migration/restructuring

### ❌ Inappropriate Use Cases:

-   Production environment (without extreme caution)
-   When you want to delete specific tenants (use tenant-specific deletion instead)
-   Regular maintenance (consider archiving instead)

---

## Alternative: Delete Specific Tenant

If you only want to delete a specific tenant, you can use:

```php
use App\Models\Tenant;
use Illuminate\Support\Facades\DB;

DB::transaction(function () {
    $tenant = Tenant::find($tenantId);

    if ($tenant) {
        // Due to cascade deletes in migrations, this should handle most related records
        $tenant->delete();
    }
});
```

Or create a command for single tenant deletion:

```bash
php artisan tenant:delete {tenant-id}
```

---

## Script Maintenance

If you add new tables with `tenant_id` in the future:

1. **Update the table list** in both scripts
2. **Add the table** in the appropriate order (respect dependencies)
3. **Test thoroughly** in a development environment
4. **Document the changes** in this file

---

## Support

For issues or questions:

-   Check the error messages in the output
-   Review the database schema for dependencies
-   Ensure proper database permissions
-   Verify Laravel configuration

---

## License & Disclaimer

These scripts are provided as-is. The authors are not responsible for any data loss resulting from the use of these scripts. Always maintain proper backups and test thoroughly before use in any environment.
