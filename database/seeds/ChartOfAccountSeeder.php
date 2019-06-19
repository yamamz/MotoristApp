<?php

use Illuminate\Database\Seeder;
use App\AccountCategory;
use App\Account;
use App\Location;

class ChartOfAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Location::create([
            'name'=>'Bohol Main',
            'code'=>'001'
        ]);
        Location::create([
            'name'=>'Cebu',
            'code'=>'002'
        ]);
        Location::create([
            'name'=>'Dumaguete',
            'code'=>'002'
        ]);

        AccountCategory::create([
            'name'=>'Current Assets',
        ]);
        AccountCategory::create([
            'name'=>'Property, Plant, and Equipment',
        ]);
        AccountCategory::create([
            'name'=>'Current Liabilities',
        ]);
        AccountCategory::create([
            'name'=>'Long-term Liabilities',
        ]);
        AccountCategory::create([
            'name'=>'Stockholder\'s Equity ',
        ]);
        AccountCategory::create([
            'name'=>'Operating Revenues',
        ]);
        AccountCategory::create([
            'name'=>'Cost of Goods Sold',
        ]);
        AccountCategory::create([
            'name'=>'Main Branch Expenses',
        ]);
        AccountCategory::create([
            'name'=>'Other',
        ]);


Account::create([
    'account_category_id'=>1,
    'name'=>'Cash',
    'account_code'=>10100
]);
Account::create([
    'account_category_id'=>1,
    'name'=>'Cash in Bank',
    'account_code'=>10200
]);
Account::create([
    'account_category_id'=>1,
    'name'=>'Petty Cash Fund',
    'account_code'=>10300 
]);
Account::create([
    'account_category_id'=>1,
    'name'=>'Accounts Receivable',
    'account_code'=>12100
]);
Account::create([
    'account_category_id'=>1,
    'name'=>'Allowance for Doubtful Accounts',
    'account_code'=>12200 
]);
Account::create([
    'account_category_id'=>1,
    'name'=>'Inventory',
    'account_code'=>13100
]);
Account::create([
    'account_category_id'=>1,
    'name'=>'Supplies',
    'account_code'=>14100
]);
Account::create([
    'account_category_id'=>1,
    'name'=>'Prepaid Insurance',
    'account_code'=>15100
]);

Account::create([
    'account_category_id'=>2,
    'name'=>'Land',
    'account_code'=>16100 
]);
Account::create([
    'account_category_id'=>2,
    'name'=>'Buildings',
    'account_code'=>16200 
]);
Account::create([
    'account_category_id'=>2,
    'name'=>'Office Equipment',
    'account_code'=>16300  
]);
Account::create([
    'account_category_id'=>2,
    'name'=>'Transportation Equipment',
    'account_code'=>16400  
]);
Account::create([
    'account_category_id'=>2,
    'name'=>'Furniture and Fixtures',
    'account_code'=>16500  
]);
Account::create([
    'account_category_id'=>2,
    'name'=>'Accumulated Depreciation - Buildings',
    'account_code'=>17100 
]);
Account::create([
    'account_category_id'=>2,
    'name'=>'Accumulated Depreciation - Office Equipment',
    'account_code'=>17200 
]);
Account::create([
    'account_category_id'=>2,
    'name'=>'Accumulated Depreciation - Transportation Equipment',
    'account_code'=>17300 
]);
Account::create([
    'account_category_id'=>2,
    'name'=>'Accumulated Depreciation- Furniture and Fixtures',
    'account_code'=>17400  
]);

Account::create([
    'account_category_id'=>3,
    'name'=>'Accounts Payable',
    'account_code'=>20100    
]);
Account::create([
    'account_category_id'=>3,
    'name'=>'Interest Payable',
    'account_code'=>20200    
]);
Account::create([
    'account_category_id'=>3,
    'name'=>'Unearned Revenues',
    'account_code'=>20300
]);
Account::create([
    'account_category_id'=>4,
    'name'=>'Mortgage Loan Payable',
    'account_code'=>22100 
]);
Account::create([
    'account_category_id'=>4,
    'name'=>'Accounts Payable-Giant',
    'account_code'=>22200
]);
Account::create([
    'account_category_id'=>4,
    'name'=>'Accounts Payable',
    'account_code'=>22300
]);





Account::create([
    'account_category_id'=>5,
    'name'=>'Common Stock, No Par',
    'account_code'=>23100 
]);
Account::create([
    'account_category_id'=>5,
    'name'=>'Retained Earnings',
    'account_code'=>23200
]);
Account::create([
    'account_category_id'=>5,
    'name'=>'Treasury Stock',
    'account_code'=>23300
]);





Account::create([
    'account_category_id'=>6,
    'name'=>'Donation Income – Bohol Main',
    'account_code'=>30100 
]);
Account::create([
    'account_category_id'=>6,
    'name'=>'Donation Income – Cebu',
    'account_code'=>30200
]);
Account::create([
    'account_category_id'=>6,
    'name'=>'Donation Income – Dumaguete',
    'account_code'=>30300 
]);

 
 



Account::create([
    'account_category_id'=>7,
    'name'=>'COGS - Division #1',
    'account_code'=>40100  
]);
Account::create([
    'account_category_id'=>7,
    'name'=>'COGS - Division #2',
    'account_code'=>40200  
]);
Account::create([
    'account_category_id'=>7,
    'name'=>'COGS - Division #3',
    'account_code'=>40300  
]);
Account::create([
    'account_category_id'=>7,
    'name'=>'COGS - Division #4',
    'account_code'=>40400 
]);

Account::create([
    'account_category_id'=>8,
    'name'=>'Salaries and Wages',
    'account_code'=>50100    
]);
Account::create([
    'account_category_id'=>8,
    'name'=>'Stationary and Supplies',
    'account_code'=>50200    
]);
Account::create([
    'account_category_id'=>8,
    'name'=>'Communication Expense',
    'account_code'=>50300    
]);
Account::create([
    'account_category_id'=>8,
    'name'=>'Light and Water',
    'account_code'=>50400 
]);
Account::create([
    'account_category_id'=>8,
    'name'=>'Donation Expense',
    'account_code'=>50500	  
]);
Account::create([
    'account_category_id'=>8,
    'name'=>'Fuel and Transportation',
    'account_code'=>50600	  
]);
Account::create([
    'account_category_id'=>8,
    'name'=>'Taxes and Licenses',
    'account_code'=>50700 
]);
Account::create([
    'account_category_id'=>8,
    'name'=>'Professional Fee',
    'account_code'=>50800    
]);



Account::create([
    'account_category_id'=>9,
    'name'=>'Gain on Sale of Assets',
    'account_code'=>91800     
]);
Account::create([
    'account_category_id'=>9,
    'name'=>'Loss on Sale of Assets',
    'account_code'=>96100    
]);






}
}
