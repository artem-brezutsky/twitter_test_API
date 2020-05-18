##Laravel Twitter API

###Examples urls:
####Add
{endpoint}/api/add?id=bdwFem5dfVfgONbhH6s13Kdohq1GcCZB&user=noobde&secret=1dda42fc6b8a0a0fbf08fed537f2cd6d7e8c9b84

id = bdwFem5dfVfgONbhH6s13Kdohq1GcCZB
user = noobde
secret = sha1(id . user) = 1dda42fc6b8a0a0fbf08fed537f2cd6d7e8c9b84
#
####Remove
{endpoint}/api/remove?id=bdwFem5dfVfgONbhH6s13Kdohq1GcCZB&user=noobde&secret=1dda42fc6b8a0a0fbf08fed537f2cd6d7e8c9b84

id = bdwFem5dfVfgONbhH6s13Kdohq1GcCZB
user = noobde
secret = sha1(id . user) = 1dda42fc6b8a0a0fbf08fed537f2cd6d7e8c9b84

#
####Feed
{endpoint}/api/feed?id=bdwFem5dfVfgONbhH6s13Kdohq1GcCZB&secret=d960e0a9757e428d1e4993a415ddac196292d342

id = bdwFem5dfVfgONbhH6s13Kdohq1GcCZB
secret = sha1(id) = d960e0a9757e428d1e4993a415ddac196292d342