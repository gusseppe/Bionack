import sys

def lcs(a=[], b=[]):
    if a == [] or b == []:
        return []
 
    l = len(a) + len(b) - 1
 
    # Fill non-comparable elements with null spaces.
    sa = a + (len(b) - 1) * ['']
    sb = (len(a) - 1) * [''] + b
 
    longest = []
 
    for k in range(l):
        cur = []
 
        for c in range(l):
            if sa[c] != '' and sb[c] != '' and sa[c] == sb[c]:
                cur.append(sa[c])
            else:
                if len(cur) > len(longest):
                    longest = cur
 
                cur = []
 
        if len(cur) > len(longest):
            longest = cur
 
        if sa[len(sa) - 1] == '':
            # Shift 'a' to the right.
            sa = [''] + sa[: len(sa) - 1]
        else:
            # Shift 'b' to the left.
            sb = sb[1:] + ['']
 
    return longest

def findSubList(l=[], sub=[]):
    if len(sub) > len(l):
        return -1
 
    for i in range(len(l) - len(sub) + 1):
        j = 0
        eq = True
 
        for s in sub:
            if l[i + j] != s:
                eq = False
 
                break
 
            j += 1
 
        if eq:
            return i
 
    return -1
 
def alignSequences(sequence1=[], sequence2=[]):
    # lcs is the Longest Common Subsequence function.
    cs = lcs(sequence1, sequence2)
 
    if cs == []:
        return sequence1 + [''] * len(sequence2) , \
               [''] * len(sequence1) + sequence2
    else:
        # Remainings non-aligned sequences in the left side.
        left1 = sequence1[: findSubList(sequence1, cs)]
        left2 = sequence2[: findSubList(sequence2, cs)]
 
        # Remainings non-aligned sequences in the right side.
        right1 = sequence1[findSubList(sequence1, cs) + len(cs):]
        right2 = sequence2[findSubList(sequence2, cs) + len(cs):]
 
        # Align the sequences in the left and right sides:
        leftAlign = alignSequences(left1, left2)
        rightAlign = alignSequences(right1, right2)
 
        return leftAlign[0] + cs + rightAlign[0], \
               leftAlign[1] + cs + rightAlign[1]
 
 
seq1 = sys.argv[1];
seq2 = sys.argv[2];

#a, b = alignSequences(list('abcdfghjqz'), list('abcdefgijkrxyz'))
a, b = alignSequences(list(seq1), list(seq2))
#print 'abcdfghjqz'
#print 'abcdefgijkrxyz'
#print

f = open("output.txt", "w")
f.write(''.join(['-' if i == '' else i for i in a]))
f.write(' ')
f.write(''.join(['-' if j == '' else j for j in b]))
#f.write('\n')

#print (''.join(['-' if i == '' else i for i in a]))
#print (''.join(['-' if j == '' else j for j in b]))
