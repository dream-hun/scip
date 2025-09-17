import AppLayout from '@/layouts/app-layout';
import type { BreadcrumbItem } from '@/types';
import cooperatives from '@/routes/cooperatives';
import { Head, Form, Link } from '@inertiajs/react';

import InputError from '@/components/input-error';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Button } from '@/components/ui/button';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Cooperatives',
        href: cooperatives.index().url,
    },
    {
        title: 'Create',
        href: cooperatives.create().url,
    },
];

export default function Create() {
    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Create cooperative" />

            <div className="space-y-6">
                <div className="rounded-lg border border-sidebar-border/70 dark:border-sidebar-border p-4">
                    <Form action={cooperatives.store().url} method="post" options={{ preserveScroll: true }} className="space-y-6">
                        {({ processing, errors }) => (
                            <>
                                <div className="grid gap-2">
                                    <Label htmlFor="name">Name</Label>
                                    <Input id="name" name="name" placeholder="Cooperative name" />
                                    <InputError message={errors.name} className="mt-2" />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="region">Region</Label>
                                    <Input id="region" name="region" placeholder="Region" />
                                    <InputError message={errors.region} className="mt-2" />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="address">Address</Label>
                                    <Input id="address" name="address" placeholder="Street address or PO Box" />
                                    <InputError message={errors.address} className="mt-2" />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="contact_person">Contact person</Label>
                                    <Input id="contact_person" name="contact_person" placeholder="Full name" />
                                    <InputError message={errors.contact_person} className="mt-2" />
                                </div>

                                <div className="grid gap-2">
                                    <Label htmlFor="phone">Phone</Label>
                                    <Input id="phone" name="phone" placeholder="Phone number" />
                                    <InputError message={errors.phone} className="mt-2" />
                                </div>

                                <div className="flex items-center gap-3 justify-end">
                                    <Link href={cooperatives.index().url} className="underline text-muted-foreground">Cancel</Link>
                                    <Button type="submit" disabled={processing}>Create</Button>
                                </div>
                            </>
                        )}
                    </Form>
                </div>
            </div>
        </AppLayout>
    );
}

