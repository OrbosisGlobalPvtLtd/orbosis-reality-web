<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\CompanyProfile;
use App\Models\Builder;
use App\Models\Order;
use Illuminate\Support\Facades\Hash;

class AgencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Seed Real Agencies
        $agencies_data = [
            [
                'name' => 'Orbosis Realty',
                'user_name' => 'orbosis_realty',
                'email' => 'contact@orbosisrealty.com',
                'company_name' => 'Orbosis Realty Pvt Ltd',
                'tag_line' => 'Premier Luxury & Commercial Real Estate Agency in Indore',
                'address' => 'AB Road, Vijay Nagar, Indore, MP 452010',
                'phone' => '+91 9875643210',
                'image' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=600&auto=format&fit=crop&q=80',
                'about_us' => 'Orbosis Realty is Indore\'s leading real estate advisory firm specializing in premium residential apartments, luxury villas, commercial office spaces, and investment land.',
                'facebook' => 'https://facebook.com/orbosisrealty',
                'twitter' => 'https://twitter.com/orbosisrealty',
                'linkedin' => 'https://linkedin.com/company/orbosisrealty',
                'instagram' => 'https://instagram.com/orbosisrealty',
            ],
            [
                'name' => 'Apex Infrastructure',
                'user_name' => 'apex_infra',
                'email' => 'info@apexinfra.in',
                'company_name' => 'Apex Infrastructure & Realty',
                'tag_line' => 'Trusted Commercial Spaces & Integrated Townships',
                'address' => 'Super Corridor, Near IT Park, Indore, MP 452005',
                'phone' => '+91 9826012345',
                'image' => 'https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?w=600&auto=format&fit=crop&q=80',
                'about_us' => 'Apex Infrastructure has delivered over 15+ township projects across Madhya Pradesh. We specialize in RERA-approved commercial hubs and luxury gated communities.',
                'facebook' => 'https://facebook.com/apexinfra',
                'twitter' => 'https://twitter.com/apexinfra',
                'linkedin' => 'https://linkedin.com/company/apexinfra',
                'instagram' => 'https://instagram.com/apexinfra',
            ],
            [
                'name' => 'Skyline Properties',
                'user_name' => 'skyline_prop',
                'email' => 'sales@skylineprop.com',
                'company_name' => 'Skyline Properties & Associates',
                'tag_line' => 'Connecting Buyers to Dream Homes & Premium Plots',
                'address' => 'Bhawarkua Main Road, Near Tower Square, Indore, MP 452001',
                'phone' => '+91 9893098765',
                'image' => 'https://images.unsplash.com/photo-1554469384-e58fac16e23a?w=600&auto=format&fit=crop&q=80',
                'about_us' => 'Skyline Properties offers personalized property advisory services with transparent documentation and complete buyer protection.',
                'facebook' => 'https://facebook.com/skylineprop',
                'twitter' => 'https://twitter.com/skylineprop',
                'linkedin' => 'https://linkedin.com/company/skylineprop',
                'instagram' => 'https://instagram.com/skylineprop',
            ],
            [
                'name' => 'Vanguard Realty',
                'user_name' => 'vanguard_realty',
                'email' => 'support@vanguardrealty.com',
                'company_name' => 'Vanguard Realty Group',
                'tag_line' => 'High-Yield Real Estate Investment & Consultancy',
                'address' => 'Palasia Square, Old Palasia, Indore, MP 452018',
                'phone' => '+91 9752044332',
                'image' => 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=600&auto=format&fit=crop&q=80',
                'about_us' => 'Vanguard Realty assists NRI investors and high-net-worth individuals in portfolio diversification across prime commercial assets.',
                'facebook' => 'https://facebook.com/vanguardrealty',
                'twitter' => 'https://twitter.com/vanguardrealty',
                'linkedin' => 'https://linkedin.com/company/vanguardrealty',
                'instagram' => 'https://instagram.com/vanguardrealty',
            ],
            [
                'name' => 'Mahalaxmi Realtors',
                'user_name' => 'mahalaxmi_realtors',
                'email' => 'mahalaxmirealtors@gmail.com',
                'company_name' => 'Mahalaxmi Realtors',
                'tag_line' => '30+ Years of Trust in Residential & Farm Land',
                'address' => 'Navlakha Square, AB Road, Indore, MP 452001',
                'phone' => '+91 9425055443',
                'image' => 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=600&auto=format&fit=crop&q=80',
                'about_us' => 'Established in 1994, Mahalaxmi Realtors is one of the oldest and most respected real estate consultancies in Central India.',
                'facebook' => 'https://facebook.com/mahalaxmirealtors',
                'twitter' => 'https://twitter.com/mahalaxmirealtors',
                'linkedin' => 'https://linkedin.com/company/mahalaxmirealtors',
                'instagram' => 'https://instagram.com/mahalaxmirealtors',
            ],
            [
                'name' => 'Indore Elite Spaces',
                'user_name' => 'indore_elite',
                'email' => 'hello@indoreelitespaces.com',
                'company_name' => 'Indore Elite Spaces',
                'tag_line' => 'Boutique Property Advisory for Gated Communities',
                'address' => 'Saket Nagar, Near Saket Club, Indore, MP 452018',
                'phone' => '+91 9827011223',
                'image' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=600&auto=format&fit=crop&q=80',
                'about_us' => 'Indore Elite Spaces curates handpicked penthouses, independent bungalows, and prime plots in premium neighborhoods of Indore.',
                'facebook' => 'https://facebook.com/indoreelitespaces',
                'twitter' => 'https://twitter.com/indoreelitespaces',
                'linkedin' => 'https://linkedin.com/company/indoreelitespaces',
                'instagram' => 'https://instagram.com/indoreelitespaces',
            ],
        ];

        foreach ($agencies_data as $agency) {
            $user = User::updateOrCreate(
                ['email' => $agency['email']],
                [
                    'name' => $agency['name'],
                    'user_name' => $agency['user_name'],
                    'password' => Hash::make('password'),
                    'status' => 1,
                    'is_agency' => 1,
                    'image' => $agency['image'],
                    'phone' => $agency['phone'],
                    'address' => $agency['address'],
                    'kyc_status' => 1,
                    'facebook' => $agency['facebook'],
                    'twitter' => $agency['twitter'],
                    'linkedin' => $agency['linkedin'],
                    'instagram' => $agency['instagram'],
                ]
            );

            CompanyProfile::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'company_name' => $agency['company_name'],
                    'tag_line' => $agency['tag_line'],
                    'about_us' => $agency['about_us'],
                    'email' => $agency['email'],
                    'phone' => $agency['phone'],
                    'image' => $agency['image'],
                    'address' => $agency['address'],
                    'is_approved' => 1,
                    'facebook' => $agency['facebook'],
                    'twitter' => $agency['twitter'],
                    'linkedin' => $agency['linkedin'],
                    'instagram' => $agency['instagram'],
                ]
            );

            Order::firstOrCreate(
                ['agent_id' => $user->id],
                [
                    'order_id' => 'ORD-' . rand(10000, 99999),
                    'user_id' => $user->id,
                    'pricing_plan_id' => 1,
                    'purchase_date' => date('Y-m-d'),
                    'payment_status' => 'success'
                ]
            );
        }

        // 2. Seed Real Single Agents
        $agents_data = [
            [
                'name' => 'Rajesh Sharma',
                'user_name' => 'rajesh_sharma',
                'email' => 'rajesh.sharma@orbosisrealty.com',
                'designation' => 'Senior Real Estate Consultant',
                'phone' => '+91 9826123456',
                'address' => 'Vijay Nagar, Indore',
                'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=600&auto=format&fit=crop&q=80',
                'about_me' => '12+ years of experience in residential property sales, plot evaluation, and home loan assistance in Indore.',
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'linkedin' => 'https://linkedin.com',
                'instagram' => 'https://instagram.com',
            ],
            [
                'name' => 'Priyanka Verma',
                'user_name' => 'priyanka_verma',
                'email' => 'priyanka.v@orbosisrealty.com',
                'designation' => 'Luxury Residential Specialist',
                'phone' => '+91 9826789012',
                'address' => 'New Palasia, Indore',
                'image' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=600&auto=format&fit=crop&q=80',
                'about_me' => 'Specializing in luxury apartments, villas, and high-end residential listings in prime Indore localities.',
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'linkedin' => 'https://linkedin.com',
                'instagram' => 'https://instagram.com',
            ],
            [
                'name' => 'Amitabh Joshi',
                'user_name' => 'amitabh_joshi',
                'email' => 'amitabh.j@orbosisrealty.com',
                'designation' => 'Commercial & Industrial Expert',
                'phone' => '+91 9893112233',
                'address' => 'Rau Bypass, Indore',
                'image' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=600&auto=format&fit=crop&q=80',
                'about_me' => 'Helping businesses find retail shops, corporate office spaces, warehousing, and commercial land plots.',
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'linkedin' => 'https://linkedin.com',
                'instagram' => 'https://instagram.com',
            ],
            [
                'name' => 'Ananya Gupta',
                'user_name' => 'ananya_gupta',
                'email' => 'ananya.g@orbosisrealty.com',
                'designation' => 'Plot & Investment Manager',
                'phone' => '+91 9752334455',
                'address' => 'Bicholi Mardana, Indore',
                'image' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?w=600&auto=format&fit=crop&q=80',
                'about_me' => 'Expert guidance on upcoming township approvals, land appreciation trends, and legal title verification.',
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'linkedin' => 'https://linkedin.com',
                'instagram' => 'https://instagram.com',
            ],
            [
                'name' => 'Vikram Singh Rathore',
                'user_name' => 'vikram_rathore',
                'email' => 'vikram.r@orbosisrealty.com',
                'designation' => 'Chief Property Evaluator',
                'phone' => '+91 9425887766',
                'address' => 'Geeta Bhawan Square, Indore',
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=600&auto=format&fit=crop&q=80',
                'about_me' => 'Certified real estate valuer with 15+ years in legal documentation and property valuation.',
                'facebook' => 'https://facebook.com',
                'twitter' => 'https://twitter.com',
                'linkedin' => 'https://linkedin.com',
                'instagram' => 'https://instagram.com',
            ],
        ];

        foreach ($agents_data as $agent) {
            $user = User::updateOrCreate(
                ['email' => $agent['email']],
                [
                    'name' => $agent['name'],
                    'user_name' => $agent['user_name'],
                    'password' => Hash::make('password'),
                    'status' => 1,
                    'is_agency' => 0,
                    'designation' => $agent['designation'],
                    'image' => $agent['image'],
                    'phone' => $agent['phone'],
                    'address' => $agent['address'],
                    'about_me' => $agent['about_me'],
                    'kyc_status' => 1,
                    'facebook' => $agent['facebook'],
                    'twitter' => $agent['twitter'],
                    'linkedin' => $agent['linkedin'],
                    'instagram' => $agent['instagram'],
                ]
            );

            Order::firstOrCreate(
                ['agent_id' => $user->id],
                [
                    'order_id' => 'ORD-' . rand(10000, 99999),
                    'user_id' => $user->id,
                    'pricing_plan_id' => 1,
                    'purchase_date' => date('Y-m-d'),
                    'payment_status' => 'success'
                ]
            );
        }

        // 3. Clean up test Builders table entries
        Builder::whereIn('company_name', ['john doe', 'or', 'gg', 'reality finences'])->delete();
    }
}
